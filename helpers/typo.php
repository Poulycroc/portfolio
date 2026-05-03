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
            $attr = "class=\"animated-char {$options['class']}\" style=\"animation-delay: {$delay}ms; animation-duration: {$options['duration']}ms;\"";
            $html .= "<span {$attr}>{$display}</span>";
        }
        $html .= '</span>';
    }

    $html .= '</span>';

    return $html;
}

function heroAnimatedText($text, $options = [])
{
    $options = array_merge([
        'delay' => 0,
        'stagger' => 35,
        'class' => '',
    ], $options);

    $chars = preg_split('//u', $text, -1, PREG_SPLIT_NO_EMPTY);
    $html = '<span class="hero-animated-text">';

    foreach ($chars as $i => $char) {
        $delay = $options['delay'] + $i * $options['stagger'];
        $display = $char === ' ' ? '&nbsp;' : htmlspecialchars($char);
        $html .= "<span class=\"hero-char {$options['class']}\" style=\"animation-delay: {$delay}ms\">{$display}</span>";
    }

    $html .= '</span>';

    return $html;
}

return true;
