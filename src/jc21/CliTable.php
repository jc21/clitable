<?php
// +---------------------------------------------------------------+
// | CLI Table Class                                               |
// +---------------------------------------------------------------+
// | Nice output for PHP scripts on the command line               |
// +---------------------------------------------------------------+
// | Licence: MIT                                                  |
// +---------------------------------------------------------------+
// | Copyright: Jamie Curnow  <jc@jc21.com>                        |
// +---------------------------------------------------------------+
//

namespace jc21;

class CliTable {

    /**
     * Table Data
     *
     * @var    object
     * @access protected
     *
     **/
    protected $injectedData = null;

    /**
     * Table Item name
     *
     * @var    string
     * @access protected
     *
     **/
    protected $itemName = 'Row';

    /**
     * Table fields
     *
     * @var    array
     * @access protected
     *
     **/
    protected $fields = array();

    /**
     * Show column headers?
     *
     * @var    bool
     * @access protected
     *
     **/
    protected $showHeaders = true;

    /**
     * Use colors?
     *
     * @var    bool
     * @access protected
     *
     **/
    protected $useColors = true;

    /**
     * Table Border Color
     *
     * @var    string
     * @access protected
     *
     **/
    protected $tableColor = 'reset';

    /**
     * Header Color
     *
     * @var    string
     * @access protected
     *
     **/
    protected $headerColor = 'reset';

    /**
     * Colors, will be populated after instantiation
     *
     * @var    array
     * @access protected
     *
     **/
    protected $colors = array();

    /**
     * Border Characters
     *
     * @var    array
     * @access protected
     *
     **/
    protected $chars = array(
        'top'          => '═',
        'top-mid'      => '╤',
        'top-left'     => '╔',
        'top-right'    => '╗',
        'bottom'       => '═',
        'bottom-mid'   => '╧',
        'bottom-left'  => '╚',
        'bottom-right' => '╝',
        'left'         => '║',
        'left-mid'     => '╟',
        'mid'          => '─',
        'mid-mid'      => '┼',
        'right'        => '║',
        'right-mid'    => '╢',
        'middle'       => '│ ',
    );


    /**
     * Constructor
     *
     * @access public
     * @param  string $itemName
     * @param  bool   $useColors
     */
    public function __construct($itemName = 'Row', $useColors = true) {
        $this->setItemName($itemName);
        $this->setUseColors($useColors);
        $this->defineColors();
    }


    /**
     * setUseColors
     *
     * @access public
     * @param  bool  $bool
     * @return void
     */
    public function setUseColors($bool) {
        $this->useColors = (bool) $bool;
    }


    /**
     * getUseColors
     *
     * @access public
     * @return bool
     */
    public function getUseColors() {
        return $this->useColors;
    }


    /**
     * setTableColor
     *
     * @access public
     * @param  string  $color
     * @return void
     */
    public function setTableColor($color) {
        $this->tableColor = $color;
    }


    /**
     * getTableColor
     *
     * @access public
     * @return string
     */
    public function getTableColor() {
        return $this->tableColor;
    }


    /**
     * setChars
     *
     * @access public
     * @param  array  $chars
     * @return void
     */
    public function setChars($chars) {
        $this->chars = $chars;
    }


    /**
     * setHeaderColor
     *
     * @access public
     * @param  string  $color
     * @return void
     */
    public function setHeaderColor($color) {
        $this->headerColor = $color;
    }


    /**
     * getHeaderColor
     *
     * @access public
     * @return string
     */
    public function getHeaderColor() {
        return $this->headerColor;
    }


    /**
     * setItemName
     *
     * @access public
     * @param  string  $name
     * @return void
     */
    public function setItemName($name) {
        $this->itemName = $name;
    }


    /**
     * getItemName
     *
     * @access public
     * @return string
     */
    public function getItemName() {
        return $this->itemName;
    }


    /**
     * injectData
     *
     * @access public
     * @param  array  $data
     * @return void
     */
    public function injectData($data) {
        $this->injectedData = $data;
    }


    /**
     * setShowHeaders
     *
     * @access public
     * @param  bool  $bool
     * @return void
     */
    public function setShowHeaders($bool) {
        $this->showHeaders = $bool;
    }


    /**
     * getShowHeaders
     *
     * @access public
     * @return bool
     */
    public function getShowHeaders() {
        return $this->showHeaders;
    }


    /**
     * getPluralItemName
     *
     * @access protected
     * @return string
     */
    protected function getPluralItemName() {
        if (count($this->injectedData) == 1) {
            return $this->getItemName();
        } else {
            $lastChar = strtolower(substr($this->getItemName(), strlen($this->getItemName()) -1, 1));
            if ($lastChar == 's') {
                return $this->getItemName() . 'es';
            } else if ($lastChar == 'y') {
                return substr($this->getItemName(), 0, strlen($this->getItemName()) - 1) . 'ies';
            } else {
                return $this->getItemName().'s';
            }
        }
    }


    /**
     * addField
     *
     * @access public
     * @param  string      $fieldName
     * @param  string      $fieldKey
     * @param  bool|object $manipulator
     * @param  string      $color
     * @return void
     */
    public function addField($fieldName, $fieldKey, $manipulator = false, $color = 'reset') {
        $this->fields[$fieldKey] = array(
            'name'        => $fieldName,
            'key'         => $fieldKey,
            'manipulator' => $manipulator,
            'color'       => $color,
        );
    }


    /**
     * get
     *
     * @access public
     * @return string
     */
    public function get() {
        $rowCount      = 0;
        $columnLengths = array();
        $headerData    = array();
        $cellData      = array();

        // Headers
        if ($this->getShowHeaders()) {
            foreach ($this->fields as $field) {
                $headerData[$field['key']] = trim($field['name']);

                // Column Lengths
                if (!isset($columnLengths[$field['key']])) {
                    $columnLengths[$field['key']] = 0;
                }
                $columnLengths[$field['key']] = max($columnLengths[$field['key']], strlen(trim($field['name'])));
            }
        }

        // Data
        if ($this->injectedData !== null) {
            if (count($this->injectedData)) {
                foreach ($this->injectedData as $row) {
                    // Row
                    $cellData[$rowCount] = array();
                    foreach ($this->fields as $field) {
                        $key   = $field['key'];
                        $value = $row[$key];
                        if ($field['manipulator'] instanceof CliTableManipulator) {
                            $value = trim($field['manipulator']->manipulate($value, $row, $field['name']));
                        }

                        $cellData[$rowCount][$key] = $value;

                        // Column Lengths
                        if (!isset($columnLengths[$key])) {
                            $columnLengths[$key] = 0;
                        }
                        $columnLengths[$key] = max($columnLengths[$key], strlen($value));
                    }
                    $rowCount++;
                }
            } else {
                return 'There are no '.$this->getPluralItemName() . PHP_EOL;
            }
        } else {
            return 'There is no injected data for the table!' . PHP_EOL;
        }

        $response = '';

        // Now draw the table!
        $response .= $this->getTableTop($columnLengths);
        if ($this->getShowHeaders()) {
            $response .= $this->getFormattedRow($headerData, $columnLengths, true);
            $response .= $this->getTableSeperator($columnLengths);
        }

        foreach ($cellData as $row) {
            $response .= $this->getFormattedRow($row, $columnLengths);
        }

        $response .= $this->getTableBottom($columnLengths);

        return $response;
    }


    /**
     * getFormattedRow
     *
     * @access protected
     * @param  array   $rowData
     * @param  array   $columnLengths
     * @param  bool    $header
     * @return string
     */
    protected function getFormattedRow($rowData, $columnLengths, $header = false) {
        $response = $this->getChar('left');

        foreach ($rowData as $key => $field) {
            if ($header) {
                $color = $this->getHeaderColor();
            } else {
                $color = $this->fields[$key]['color'];
            }

            $fieldLength  = mb_strwidth($field) + 1;
            $field        = ' '.($this->getUseColors() ? $this->getColorFromName($color) : '').$field;
            $response    .= $field;

            for ($x = $fieldLength; $x < ($columnLengths[$key] + 2); $x++) {
                $response .= ' ';
            }
            $response .= $this->getChar('middle');
        }

        $response = substr($response, 0, strlen($response) - 3) . $this->getChar('right') . PHP_EOL;
        return $response;
    }


    /**
     * getTableTop
     *
     * @access protected
     * @param  array   $columnLengths
     * @return string
     */
    protected function getTableTop($columnLengths) {
        $response = $this->getChar('top-left');
        foreach ($columnLengths as $length) {
            $response .= $this->getChar('top', $length + 2);
            $response .= $this->getChar('top-mid');
        }
        $response = substr($response, 0, strlen($response) - 3) . $this->getChar('top-right') . PHP_EOL;
        return $response;
    }


    /**
     * getTableBottom
     *
     * @access protected
     * @param  array   $columnLengths
     * @return string
     */
    protected function getTableBottom($columnLengths) {
        $response = $this->getChar('bottom-left');
        foreach ($columnLengths as $length) {
            $response .= $this->getChar('bottom', $length + 2);
            $response .= $this->getChar('bottom-mid');
        }
        $response = substr($response, 0, strlen($response) - 3) . $this->getChar('bottom-right') . PHP_EOL;
        return $response;
    }


    /**
     * getTableSeperator
     *
     * @access protected
     * @param  array   $columnLengths
     * @return string
     */
    protected function getTableSeperator($columnLengths) {
        $response = $this->getChar('left-mid');
        foreach ($columnLengths as $length) {
            $response .= $this->getChar('mid', $length + 2);
            $response .= $this->getChar('mid-mid');
        }
        $response = substr($response, 0, strlen($response) - 3) . $this->getChar('right-mid') . PHP_EOL;
        return $response;
    }


    /**
     * getChar
     *
     * @access protected
     * @param  string  $type
     * @param  int     $length
     * @return string
     */
    protected function getChar($type, $length = 1) {
        $response = '';
        if (isset($this->chars[$type])) {
            if ($this->getUseColors()) {
                $response .= $this->getColorFromName($this->getTableColor());
            }
            $char = trim($this->chars[$type]);
            for ($x = 0; $x < $length; $x++) {
                $response .= $char;
            }
        }
        return $response;
    }


    /**
     * defineColors
     *
     * @access protected
     * @return void
     */
    protected function defineColors()
    {
        $this->colors = array(
            'blue'    => chr(27).'[1;34m',
            'red'     => chr(27).'[1;31m',
            'green'   => chr(27).'[1;32m',
            'yellow'  => chr(27).'[1;33m',
            'black'   => chr(27).'[1;30m',
            'magenta' => chr(27).'[1;35m',
            'cyan'    => chr(27).'[1;36m',
            'white'   => chr(27).'[1;37m',
            'grey'    => chr(27).'[0;37m',
            'reset'   => chr(27).'[0m',
        );
    }


    /**
     * getColorFromName
     *
     * @access protected
     * @param  string  $colorName
     * @return string
     */
    protected function getColorFromName($colorName)
    {
        if (isset($this->colors[$colorName])) {
            return $this->colors[$colorName];
        }
        return $this->colors['reset'];
    }


    /**
     * display
     *
     * @access public
     * @return void
     */
    public function display() {
        print $this->get();
    }

}
