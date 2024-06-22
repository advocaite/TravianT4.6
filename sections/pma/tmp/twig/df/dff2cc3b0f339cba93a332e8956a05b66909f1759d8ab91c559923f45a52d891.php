<?php

/* privileges/require_options.twig */
class __TwigTemplate_d84e01d145e64d3e38a84587281be04fd8d55876d4c16047819cb13915f18600 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<fieldset>
    <legend>SSL</legend>
    <div id=\"require_ssl_div\">
        ";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["require_options"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["require_option"]) {
            // line 5
            echo "            ";
            if (($this->getAttribute($context["require_option"], "name", array(), "array") === "ssl_cipher")) {
                // line 6
                echo "                <div id=\"specified_div\" style=\"padding-left:20px;\">
            ";
            }
            // line 8
            echo "            ";
            $this->loadTemplate("privileges/require_options_item.twig", "privileges/require_options.twig", 8)->display(array("require_option" =>             // line 9
$context["require_option"]));
            // line 11
            echo "        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['require_option'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 12
        echo "        </div>";
        // line 13
        echo "    </div>";
        // line 14
        echo "</fieldset>
";
    }

    public function getTemplateName()
    {
        return "privileges/require_options.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  49 => 14,  47 => 13,  45 => 12,  39 => 11,  37 => 9,  35 => 8,  31 => 6,  28 => 5,  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "privileges/require_options.twig", "/home/travian/pma/templates/privileges/require_options.twig");
    }
}
