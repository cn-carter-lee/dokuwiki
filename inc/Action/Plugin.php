<?php

namespace dokuwiki\Action;

/**
 * Class Plugin
 *
 * Used to run action plugins
 *
 * @package dokuwiki\Action
 */
class Plugin extends AbstractAction {

    /** @inheritdoc */
    function minimumPermission() {
        return AUTH_NONE;
    }

    /**
     * Outputs nothing but a warning unless an action plugin overwrites it
     *
     * @inheritdoc
     * @triggers TPL_ACT_UNKNOWN
     */
    public function tplContent() {
        $evt = new \Doku_Event('TPL_ACT_UNKNOWN', $this->actionname);
        if($evt->advise_before()) {
            msg('Failed to handle action: ' . hsc($this->actionname), -1);
        }
        $evt->advise_after();
    }

    /**
     * Set the action name
     *
     * This class handles arbitrary names by passing them to action plugins
     * later in tplContent(). The actual name (=$ACT) is via this function
     * in ActionRouter::setupAction()
     *
     * @param string $actionname
     */
    public function setActionName($actionname) {
        $this->actionname = $actionname;
    }
}