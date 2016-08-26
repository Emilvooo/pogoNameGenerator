<?php
class pogoNameGenerator
{
    public $names = array();

    public function __construct()
    {
        $this->names = preg_split('/\n|\r/', $this->getPost('name'), -1, PREG_SPLIT_NO_EMPTY);

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $this->runGenerator();
        }
    }

    private function runGenerator()
    {
        if ($this->getPost('randomnick'))
        {
            $this->generateRandomNickname();
        }
        if ($this->getPost('randomcheck'))
        {
            $this->addRandomString();
        }
        if ($this->getPost('passcheck'))
        {
            $this->addPassword();
        }
        if ($this->getPost('comma'))
        {
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
        $add_string = $this->addToNames(false, 'generateRandomString', true);
        $this->names = $add_string;
    }

    private function addPassword()
    {
        $add_password = $this->addToNames(':'.$this->getPost('password'), false, false);
        $this->names = $add_password;
    }

    private function addComma()
    {
        $add_comma = $this->addToNames($this->getPost('comma'), false, false);
        $this->names = $add_comma;
    }

    private function generateRandomString()
    {
        $string_shuffle = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $this->getPost('quantity-string'));
        return $string_shuffle;
    }

    private function addToNames($value, $function, $preg_replace_callback)
    {
        if ($function && $preg_replace_callback  == true)
        {
            return preg_replace_callback('/$/', function() use(&$function) { return $this->$function(); }, $this->names);
        }
        else
        {
            return preg_replace('/$/', $value, $this->names);
        }
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
