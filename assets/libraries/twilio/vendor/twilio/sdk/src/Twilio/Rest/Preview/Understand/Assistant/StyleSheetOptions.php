<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\Understand\Assistant;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class StyleSheetOptions {
    /**
     * @param array $styleSheet The JSON Style sheet string
     * @return UpdateStyleSheetOptions Options builder
     */
    public static function update($styleSheet = Values::NONE) {
        return new UpdateStyleSheetOptions($styleSheet);
    }
}

class UpdateStyleSheetOptions extends Options {
    /**
     * @param array $styleSheet The JSON Style sheet string
     */
    public function __construct($styleSheet = Values::NONE) {
        $this->options['styleSheet'] = $styleSheet;
    }

    /**
     * The JSON Style sheet string
     *
     * @param array $styleSheet The JSON Style sheet string
     * @return $this Fluent Builder
     */
    public function setStyleSheet($styleSheet) {
        $this->options['styleSheet'] = $styleSheet;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Preview.Understand.UpdateStyleSheetOptions ' . implode(' ', $options) . ']';
    }
}