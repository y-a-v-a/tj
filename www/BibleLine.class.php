<?php
class BibleLine {
    private $sp;
    
    private $urls = array(
    	"ftp://eremita.di.uminho.pt/pub/gutenberg/etext05",
    	"http://www.gutenberg.org/dirs/etext05",
    	"http://www.gutenberg.lib.md.us/etext05",
    	"ftp://indian.cse.msu.edu/pub/mirrors/Gutenberg/etext05",
    	"http://gutenberg.mirrors.tds.net/pub/gutenberg.org/etext05",
    	"http://mirrors.xmission.com/gutenberg/etext05",
    	"ftp://sunsite.informatik.rwth-aachen.de/pub/mirror/ibiblio/gutenberg/etext05",
    	"ftp://cis.uniroma2.it/gutenberg/etext05"
    	);
    
    private $cache = array();
    
    public function __construct($sp) {
        $this->sp = $sp;
    }
    
    public function getLine() {
        $i = 0;
        do {
            $bookUrl = $this->getUrl();
            $raw = $this->getRawData($bookUrl);
            $i++;
            if ($i === 5) {
                return '';
            }
        } while ($raw === false);
        return $this->processRaw($raw);
    }
    
    private function processRaw($cnt) {
        // strip meta-data to get main text
        $cnt = strstr($cnt, '1:1');
        // strip meta-data from end of file
        $cnt = strrev(strstr(strrev($cnt), strrev('*** END')));

        $cnt = substr($cnt, 0, strlen($cnt) - strlen('*** END'));

        // do some regexp to get the right sentence part
        switch ($this->sp) {
        	case '0':
        		preg_match_all("/[A-Z]{1}[a-z]*[ ]{1}([a-z0-9:\-,]*[ ]){4,12}/",$cnt, $matches);
        		break;
        	case '1':
        		preg_match_all("/[ ]{1}[a-z]{1}([A-Za-z\-,:]*[ ]){6,}/",$cnt, $matches);
        		break;
        	case '2':
        		preg_match_all("/([ ]+?[a-z][A-Za-z\-,:]*){6,13}([\.\?!]){1}/",$cnt, $matches,PREG_PATTERN_ORDER);
        		break;
        }

        if (isset($matches[0]) && count($matches[0]) > 0) {
            $index = rand(0, count($matches[0]) - 1);
            $line = trim($matches[0][$index]);
            if ($this->sp === 0) {
                $line = ucfirst($line);
            } else if ($this->sp === 2 && !preg_match("/[\.\?\!]/", substr($line, -1))) {
                $line .= '.';
            }
        	return $line . ' ';
        }
        return '';
    }
    
    private function getUrl() {
        $baseUrl = $this->urls[rand(0, count($this->urls) - 1)];
        $book = $this->getBook();
        return $baseUrl . '/' . $book;
    }
    
    private function getBook() {
        $book = str_pad((string) rand(0,73), 2, '0', STR_PAD_LEFT);
        return 'drb' . $book . '10.txt';
    }
    
    private function getRawData($url) {
        $hash = md5($url);
        if (array_key_exists($hash, $this->cache)) {
            return $this->cache[$hash];
        }
        $raw = @file_get_contents($url);
        if ($raw !== false) {
            $this->cache[$hash] = $raw;
        }
        return $raw;
    }
    
    public function changeSp($nr) {
        if ($nr < 0 || $nr > 2) {
            throw new Exception('SentencePart should be either 0, 1 or 2');
        }
        $this->sp = $nr;
    }
}

