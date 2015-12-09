<?php
    class Xml
    {
        private $filename;
        private $contents;

        public function __construct($filename, $array)
        {
            $this->filename = $filename;
            $this->contents = $this->toXml($array);
        }

        public function asString() {
            return $this->contents;
        }

        public function publish() {
            file_put_contents($this->filename, $this->contents);
        }

        private function toXml($arr, $nest = 0) {
            $xml = '';
            foreach ($arr as $tag => $value) {
                if (is_array($value)) {
                    $xml .= $this->indent($nest) . "<{$tag}>\n";
                    $xml .= $this->toXml($value, $nest + 1);
                    $xml .= $this->indent($nest) . "</{$tag}>\n";
                } else {
                    $xml .= $this->indent($nest) . "<{$tag}>{$value}</{$tag}>\n";
                }
            }
            return $xml;
        }

        private function indent($amt) {
            $str = '';
            for ($i = 0; $i < ($amt * 2); $i++) {
                $str .= ' ';
            }
            return $str;
        }

    }
