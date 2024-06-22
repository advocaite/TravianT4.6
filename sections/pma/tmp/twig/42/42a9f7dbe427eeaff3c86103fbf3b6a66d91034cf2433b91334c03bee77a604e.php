<?php

/* display/export/selection.twig */
class __TwigTemplate_30d97d0eb2eaf284f1dc6cf38a4e4b166f247319ee5890719a9475da33faa32f extends Twig_Template
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
        echo "<div class=\"exportoptions\" id=\"databases_and_tables\">
    ";
        // line 2
        if ((($context["export_type"] ?? null) == "server")) {
            // line 3
            echo "        <h3>";
            echo _gettext("Databases:");
            echo "</h3>
    ";
        } elseif ((        // line 4
($context["export_type"] ?? null) == "database")) {
            // line 5
            echo "        <h3>";
            echo _gettext("Tables:");
            echo "</h3>
    ";
        }
        // line 7
        echo "    ";
        if ( !twig_test_empty(($context["multi_values"] ?? null))) {
            // line 8
            echo "        ";
            echo ($context["multi_values"] ?? null);
            echo "
    ";
        }
        // line 10
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "display/export/selection.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 10,  40 => 8,  37 => 7,  31 => 5,  29 => 4,  24 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "display/export/selection.twig", "/home/travian/pma/templates/display/export/selection.twig");
    }
}
