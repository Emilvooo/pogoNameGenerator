<?php
class pogoNameGenerator
{
    public $names = array();

    public function __construct()
    {
        $this->names = preg_split('/\n|\r/', $this->getPost('name'), -1, PREG_SPLIT_NO_EMPTY);

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->runGenerator();
        }
    }

    private function runGenerator()
    {
        if ($this->getPost('randomnick') == 'yes')
        {
            $this->generateRandomNick($this->getPost('quantity-nick'));
        }
        if ($this->getPost('randomcheck') == 'yes')
        {
            $this->addRandomString();
        }
        if ($this->getPost('passcheck') == 'yes')
        {
            $this->addPassword();
        }
        if ($this->getPost('comma') == 'yes')
        {
            $this->addComma();
        }
    }

    private function generateRandomNick($quantity)
    {
        $random_nickname = file_get_contents('https://donjon.bin.sh/name/rpc.cgi?type='.$this->getNickType().'&n='.$quantity.'');
        $this->names = preg_split('/\n|\r/', $random_nickname, -1, PREG_SPLIT_NO_EMPTY);
    }

    private function addRandomString()
    {
        $add_string = array_map(function($val) { return $val.$this->stringShuffle(); } , $this->names);
        $this->names = $add_string;
    }

    private function addPassword()
    {
        $add_password = array_map(function($val) { return $val.':'.$this->getPost('password'); } , $this->names);
        $this->names = $add_password;
    }

    private function addComma()
    {
        $add_comma = array_map(function($val) { return $val.','; } , $this->names);
        $this->names = $add_comma;
    }

    private function stringShuffle()
    {
        $string_shuffle = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $this->getPost('quantity-string'));
        return $string_shuffle;
    }

    private function getNickType()
    {
        $type = array('Celestial', 'Fiendish', 'Dwarvish+Male', 'Dwarvish+Female', 'Draconic+Male', 'Draconic+Female', 'Orcish+Male', 'Orcish+Female', 'Orcish+Town');
        $random_type = array_rand($type, 1);
        return $type[$random_type];
    }

    private function getPost($key, $default = null)
    {
        if (isset($_POST[$key]))
        {
            return $_POST[$key];
        }
        return $default;
    }
}
?>
