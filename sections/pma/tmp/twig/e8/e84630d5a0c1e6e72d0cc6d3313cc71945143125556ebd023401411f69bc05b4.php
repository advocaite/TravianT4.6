<?php

/* display/export/option_header.twig */
class __TwigTemplate_e26f8102f400f59a001ad4c267e39c9e5f058bdf9a9c6e2de289d1ed14528d14 extends Twig_Template
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
        echo "<div class=\"exportoptions\" id=\"header\">
    <h2>
        ";
        // line 3
        echo PhpMyAdmin\Util::getImage("b_export", _gettext("Export"));
        echo "
        ";
        // line 4
        if ((($context["export_type"] ?? null) == "server")) {
            // line 5
            echo "            ";
            echo _gettext("Exporting databases from the current server");
            // line 6
            echo "        ";
        } elseif ((($context["export_type"] ?? null) == "database")) {
            // line 7
            echo "            ";
            echo twig_escape_filter($this->env, sprintf(_gettext("Exporting tables from \"%s\" database"), ($context["db"] ?? null)), "html", null, true);
            echo "
        ";
        } else {
            // line 9
            echo "            ";
            echo twig_escape_filter($this->env, sprintf(_gettext("Exporting rows from \"%s\" table"), ($context["table"] ?? null)), "html", null, true);
            echo "
        ";
        }
        // line 11
        echo "    </h2>
</div>
";
    }

    public function getTemplateName()
    {
        return "display/export/option_header.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  47 => 11,  41 => 9,  35 => 7,  32 => 6,  29 => 5,  27 => 4,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "display/export/option_header.twig", "/home/travian/pma/templates/display/export/option_header.twig");
    }
}
