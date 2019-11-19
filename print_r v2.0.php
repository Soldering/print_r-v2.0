<?
function print_var(&$var)
{
    if (is_array($var))
    {
        if (empty($var))
            echo 'Array()';
        else
        {
            echo "<span class=\"folder\" onclick=\"$(this).next('.placeholder').fadeToggle(150).next('.array').slideToggle(150);this.textContent=this.textContent=='-'?'+':'-';\">+</span> Array(<span class=\"placeholder\">...</span><div class=\"array\">";
            foreach($var as $key => &$value)
            {
                echo '<span class="fl-l"><span class="label">[', is_string($key)?'<span class="string">"':'<span class="integer">', $key, is_string($key)?'"</span>':'</span>', ']</span> => </span>';
                print_var($value);
            }
            echo '</div>)';
        }
    }
    else if (is_bool($var))
        echo '<span class="boolean">', ($var?'true':'false'), '</span>';
    else if (is_float($var))
        echo '<span class="float">', $var, '</span>';
    else if (is_int($var))
        echo '<span class="integer">', $var, '</span>';
    else if (is_null($var))
        echo '<span class="null">null</span>';
    else if (is_object($var))
    {
        echo "<span class=\"folder\" onclick=\"$(this).next('.placeholder').fadeToggle(150).next('.object').slideToggle(150);this.textContent=this.textContent=='?'?'+':'-';\">+</span> ", get_class($var),"(<span class=\"placeholder\">...</span><div class=\"object\">";
        foreach($var as $key => &$value)
        {
            echo '<span class="fl-l"><span class="label">->', $key, '</span> = </span>';
            print_var($value);
        }
        echo '</div>)';
    }
    else if (is_resource($var))
        echo '<span class="resource">[[', get_resource_type($var), ']]</span>';
    else if (is_string($var))
        echo '<span class="string">"', $var, '"</span>';
    else
        echo '<span class="unknown">', print_r($var), '</span>';
    echo "\n";
}

function dd(&$var, $label = false)
{
    global $USER;
    if ($USER->IsAdmin())
    {
        echo "<pre class=\"p\">";
        if ($label !== false) echo '<span class="label">', $label, '</span>: ';
        print_var($var);
        echo "</pre>";
    }
}

