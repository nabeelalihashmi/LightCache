<?php

namespace IconicCodes\LightCache;


class FilesCache {

    public $cachedir = "";
    public $cache_version = "1.0.0";

    public function getValue($key) {
        $filename = $this->getHashFilename($key);
        if (file_exists($filename)) {
            $data = unserialize(file_get_contents($filename));
            $ttl = $data['t'];
            if ($ttl === 0) {
                return $data['d'];
            }
            
            if ($ttl !== 0 &&  time() >= $ttl) {
                return false;
            }
            return $data['d'];
        }
        return false;
    }

    private function sha($key) {
        return sha1($key);
    }

    private function getHashFilename($filename, $makeDirs = false) {
        if (!file_exists($this->cachedir)) {
            mkdir($this->cachedir, 0777, true);
        }
        if (strpos($filename, '.')) {
            $parts = explode('.', $filename);
            $list = array_map(function ($part) {
                return $this->sha($part);
                $part;
            }, $parts);
            $outputFilename = implode('/', $list) . '.cache';

            if ($makeDirs) {
                $dir = $this->cachedir . '/' . $outputFilename;
                if (!file_exists($dir)) {
                    $path = dirname($dir);
                    mkdir($path, 0777, true);
                }
            }
        } else {
            $outputFilename = $this->sha($filename) . '.cache';
        }

        return $this->cachedir . '/' . $outputFilename;
    }

    public function has($key) {
        $filename = $this->getHashFilename($key);
        return file_exists($filename);
    }

    public function delete($key) {
        $filename = $this->getHashFilename($key);
        if (file_exists($filename)) {
            unlink($filename);
        }
    }

    public function set($key, $value, $ttl = 0) {
        $cacheData = serialize([
            'd' => $value,
            't' => $ttl
        ]);
        file_put_contents($this->getHashFilename($key, true), $cacheData);
    }

    public function get($key, $callback) {
        $data = $this->getValue($key);
        if ($data !== false) {
            return $data;
        }
        $data = $callback();
        $this->set($key, $data[0], $data[1]);
        return $data[0];
    }
}
