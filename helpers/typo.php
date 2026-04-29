<?php

function entranceAnimatedTextChar($text, $options = [])
{
    $options = array_merge([
        'delay' => 0.2,
        'duration' => 200,
        'stagger' => 40,
        'textLevel' => 1,
        'class' => '',
    ], $options);

    $chars = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);
    $html = '<span class="animated-text-container">';

    for ($level = 0; $level < $options['textLevel']; $level++) {
        $html .= '<span class="animated-text-level level-'.$level.'" style="z-index: '.($options['textLevel'] - $level).'">';
        foreach ($chars as $ci => $char) {
            $delay = $options['delay'] + $ci * $options['stagger'];
            $c = $char === ' ' ? '&nbsp;' : htmlspecialchars($char);
            $display = "<i>{$c}</i>";
            $html .= "<span class=\"animated-char {$options['class']}\" style=\"animation-delay: {$delay}ms; animation-duration: {$options['duration']}ms;\">{$display}</span>";
        }
        $html .= '</span>';
    }

    $html .= '</span>';

    return $html;
}

return true;
