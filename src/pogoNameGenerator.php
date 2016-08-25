<?php
class pogoNameGenerator
{
    public $names = array();

    public function __construct()
    {
        $this->names = preg_split('/\n|\r/', $this->getPost('name'), -1, PREG_SPLIT_NO_EMPTY);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->runGenerator();
        }
    }

    private function runGenerator()
    {
        if ($this->getPost('randomnick') == 'yes') {
            $this->generateRandomNickname();
        }
        if ($this->getPost('randomcheck') == 'yes') {
            $this->addRandomString();
        }
        if ($this->getPost('passcheck') == 'yes') {
            $this->addPassword();
        }
        if ($this->getPost('comma') == 'yes') {
            $this->addComma();
        }
    }

    private function generateRandomNickname()
    {
        $types = array(
            'Dwarvish+Male',
            'Dwarvish+Female',
            'Draconic+Male',
            'Draconic+Female',
            'Orcish+Male',
            'Orcish+Female',
            'Incan+Male',
            'Incan+Female',
            'Sioux+Male',
            'Sioux+Female'
        );
        $random_type = array_rand($types, 1);
        $random_nickname = file_get_contents('https://donjon.bin.sh/name/rpc.cgi?type=' .  $types[$random_type] . '&n=' . $this->getPost('quantity-nick') . '');
        $this->names = preg_split('/\n|\r/', $random_nickname, -1, PREG_SPLIT_NO_EMPTY);
    }

    private function addRandomString()
    {
        $add_string = array_map(function($val)
        {
            return $val . $this->generateRandomString($this->getPost('quantity-string'));
        }, $this->names);
        $this->names = $add_string;
    }

    private function addPassword()
    {
        $add_password = array_map(function($val)
        {
            return $val . ':' . $this->getPost('password');
        }, $this->names);
        $this->names = $add_password;
    }

    private function addComma()
    {
        $add_comma = array_map(function($val)
        {
            return $val . ',';
        }, $this->names);
        $this->names = $add_comma;
    }

    private function generateRandomString($quantity)
    {
        $string_shuffle = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $quantity);
        return $string_shuffle;
    }

    private function getPost($key, $default = null)
    {
        if (isset($_POST[$key])) {
            return $_POST[$key];
        }
        return $default;
    }
}
?>
