<?php

namespace Ahmed\NovaClock;

use Laravel\Nova\Card;

class NovaClock extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    public function blink(bool $blink = true)
    {
        return $this->withMeta([
            'blink' => $blink
        ]);
    }

    public function displaySeconds(bool $displaySeconds = true)
    {
        return $this->withMeta([
            'displaySeconds' => $displaySeconds
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'nova-clock';
    }
}
