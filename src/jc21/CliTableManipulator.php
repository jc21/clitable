<?php
// +---------------------------------------------------------------+
// | CLI Table Class Manipulator                                   |
// +---------------------------------------------------------------+
// | Column functions to format data in various ways               |
// +---------------------------------------------------------------+
// | Licence: MIT                                                  |
// +---------------------------------------------------------------+
// | Copyright: Jamie Curnow  <jc@jc21.com>                        |
// +---------------------------------------------------------------+
//

namespace jc21;

class CliTableManipulator {

    /**
     * Stores the type of manipulation to perform
     *
     * @var    string
     * @access protected
     *
     **/
    protected $type = '';


    /**
     * Constructor
     *
     * @access public
     * @param  string $type
     */
    public function __construct($type) {
        $this->type = $type;
    }


    /**
     * manipulate
     * This is used by the Table class to manipulate the data passed in and returns the formatted data.
     *
     * @access public
     * @param  mixed   $value
     * @param  array   $row
     * @param  string  $fieldName
     * @return string
     */
    public function manipulate($value, $row = array(), $fieldName = '') {
        $type = $this->type;
        if ($type && is_callable(array($this, $type))) {
            return $this->$type($value, $row, $fieldName);
        } else {
            error_log('Invalid Data Manipulator type: "' . $type . '"');
            return $value . ' (Invalid Type: "' . $type . '")';
        }
    }


    /**
     * dollar
     * Changes 12300.23 to $12,300.23
     *
     * @access protected
     * @param  mixed   $value
     * @return string
     */
    protected function dollar($value) {
        return '$' . number_format($value, 2);
    }


    /**
     * date
     * Changes 1372132121 to 25-06-2013
     *
     * @access protected
     * @param  mixed   $value
     * @return string
     */
    protected function date($value) {
        if (!$value) {
            return 'Not Recorded';
        }
        return date('d-m-Y', $value);
    }


    /**
     * datelong
     * Changes 1372132121 to 25th June 2013
     *
     * @access protected
     * @param  mixed   $value
     * @return string
     */
    protected function datelong($value) {
        if (!$value) {
            return 'Not Recorded';
        }
        return date('jS F Y', $value);
    }


    /**
     * time
     * Changes 1372132121 to 1:48 pm
     *
     * @access protected
     * @param  mixed   $value
     * @return string
     */
    protected function time($value) {
        if (!$value) {
            return 'Not Recorded';
        }
        return date('g:i a', $value);
    }


    /**
     * datetime
     * Changes 1372132121 to 25th June 2013, 1:48 pm
     *
     * @access protected
     * @param  mixed   $value
     * @return string
     */
    protected function datetime($value) {
        if (!$value) {
            return 'Not Recorded';
        }
        return date('jS F Y, g:i a', $value);
    }


    /**
     * nicetime
     * Changes 1372132121 to 25th June 2013, 1:48 pm
     * Changes 1372132121 to Today, 1:48 pm
     * Changes 1372132121 to Yesterday, 1:48 pm
     *
     * @access protected
     * @param  mixed   $value
     * @return string
     */
    protected function nicetime($value) {
        if (!$value) {
            return '';
        } else if ($value > mktime(0, 0, 0, date('m'), date('d'), date('Y'))) {
            return 'Today ' . date('g:i a', $value);
        } else if ($value > mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'))) {
            return 'Yesterday ' . date('g:i a', $value);
        } else {
            return date('jS F Y, g:i a', $value);
        }
    }


    /**
     * duetime
     *
     * @access protected
     * @param  mixed   $value
     * @return string
     */
    protected function duetime($value) {
        if (!$value) {
            return '';
        } else {
            $isPast = false;
            if ($value > time()) {
                $seconds = $value - time();
            } else {
                $isPast = true;
                $seconds = time() - $value;
            }

            $text = $seconds . ' second' . ($seconds == 1 ? '' : 's');
            if ($seconds >= 60) {
                $minutes  = floor($seconds / 60);
                $seconds -= ($minutes * 60);
                $text     = $minutes . ' minute' . ($minutes == 1 ? '' : 's');
                if ($minutes >= 60) {
                    $hours    = floor($minutes / 60);
                    $minutes -= ($hours * 60);
                    $text     = $hours . ' hours, ' . $minutes . ' minute' . ($hours == 1 ? '' : 's');
                    if ($hours >= 24) {
                        $days   = floor($hours / 24);
                        $hours -= ($days * 24);
                        $text   = $days . ' day' . ($days == 1 ? '' : 's');
                        if ($days >= 365) {
                            $years = floor($days / 365);
                            $days -= ($years * 365);
                            $text  = $years . ' year' . ($years == 1 ? '' : 's');
                        }
                    }
                }
            }

            return $text . ($isPast ? ' ago' : '');
        }
    }


    /**
     * nicenumber
     *
     * @access protected
     * @param  int    $value
     * @return string
     */
    protected function nicenumber($value) {
        return number_format($value, 0);
    }


    /**
     * month
     * Changes 1372132121 to June
     *
     * @access protected
     * @param  mixed   $value
     * @return string
     */
    protected function month($value) {
        if (!$value) {
            return 'Not Recorded';
        }
        return date('F', $value);
    }


    /**
     * year
     * Changes 1372132121 to 2013
     *
     * @access protected
     * @param  mixed   $value
     * @return string
     */
    protected function year($value) {
        if (!$value) {
            return 'Not Recorded';
        }
        return date('Y', $value);
    }


    /**
     * monthyear
     * Changes 1372132121 to June 2013
     *
     * @access protected
     * @param  mixed   $value
     * @return string
     */
    protected function monthyear($value) {
        if (!$value) {
            return 'Not Recorded';
        }
        return date('F Y', $value);
    }


    /**
     * percent
     * Changes 50.2 to 50%
     *
     * @access protected
     * @param  mixed   $value
     * @return string
     */
    protected function percent($value) {
        return intval($value) . '%';
    }


    /**
     * yesno
     * Changes 0/false and 1/true to No and Yes respectively
     *
     * @access protected
     * @param  mixed   $value
     * @return string
     */
    protected function yesno($value) {
        return ($value ? 'Yes' : 'No');
    }


    /**
     * text
     * Strips input of any html
     *
     * @access protected
     * @param  mixed   $value
     * @return string
     */
    protected function text($value) {
        return strip_tags($value);
    }
}
