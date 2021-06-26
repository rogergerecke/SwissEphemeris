<?php


namespace App\SwissEphemeris;


class SystemCheck
{

    public function getSystemInfo(): string
    {
        return php_uname();
    }

    public function getPHP_version()
    {
        return phpversion();
    }

    public function ifPHP_versionOk(): bool
    {
        if(phpversion() >= '7.4'){
            return true;
        }
        return false;
    }

    public function getTerminalInfo(): string
    {
        return $this->getTerminalTool();
    }

    /**
     * Get the name off the used terminal
     * how we send the command.
     * @return string
     */
    public function getTerminalTool(): string
    {
        $shell = [
            'sh'   => 'Bourne shell',
            'csh'  => 'C shell',
            'tcsh' => 'TC shell',
            'ksh'  => 'Korn shell',
            'bash' => 'Bourne Again shell',
            '$0'   => 'Windows CMD.exe',
        ];

        exec('echo $0', $out);

        if (!is_null($out[0])) {
           return $shell[$out[0]];
        }

        return false;
    }

    /**
     * @return bool
     */
    public function is_exec_enabled(): bool
    {
        $disabled = explode(',', ini_get('disable_functions'));

        return !in_array('exec', $disabled);
    }


    /**
     * @return bool
     */
    public function is_putenv_enabled(): bool
    {

        $disabled = explode(',', ini_get('disable_functions'));

        return !in_array('putenv', $disabled);
    }

    public function ifFilePermission(): bool
    {
        $command = 'FILE="./sweph/swetest"

if ! [[ $(stat -c "%A" $FILE) =~ "r" ]]; then
  echo "Hello"
fi

exit 0';

        exec($command, $out);

        print_r($out);

        if (!is_null($out)) {
            return false;
        }
    }
}