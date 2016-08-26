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
            $this->addToNames(null);
        }
        if ($this->getPost('passcheck'))
        {
            $this->addToNames($this->getPost('password'));
        }
        if ($this->getPost('comma'))
        {
            $this->addToNames($this->getPost('comma'));
        }
        if ($this->getPost('convert'))
        {
            $this->convertNames();
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

    private function convertNames()
    {
        $convert_names = str_replace(array(':', ','), array(';', ''), $this->names);
        $this->names = $convert_names;
    }

    private function addToNames($value)
    {
        if ($value == null)
        {
            foreach ($this->names as &$name)
            {
                $name = trim($name) . substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 3);
            }
        }
        else
        {
            foreach ($this->names as &$name)
            {
                $name = trim($name) . $value;
            }
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
