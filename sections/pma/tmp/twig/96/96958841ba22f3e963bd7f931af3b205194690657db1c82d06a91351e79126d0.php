<?php

/* table/search/fields_table.twig */
class __TwigTemplate_79cc0efc1a050a50bb035733f832064ff54dbd2aa8f54ae32c11231a8b671545 extends Twig_Template
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
        echo "<table class=\"data\"";
        echo (((($context["search_type"] ?? null) == "zoom")) ? (" id=\"tableFieldsId\"") : (""));
        echo ">
    ";
        // line 2
        $this->loadTemplate("table/search/table_header.twig", "table/search/fields_table.twig", 2)->display(array("geom_column_flag" =>         // line 3
($context["geom_column_flag"] ?? null)));
        // line 5
        echo "    <tbody>
    ";
        // line 6
        if ((($context["search_type"] ?? null) == "zoom")) {
            // line 7
            echo "        ";
            $this->loadTemplate("table/search/rows_zoom.twig", "table/search/fields_table.twig", 7)->display(array("self" =>             // line 8
($context["self"] ?? null), "column_names" =>             // line 9
($context["column_names"] ?? null), "criteria_column_names" =>             // line 10
($context["criteria_column_names"] ?? null), "criteria_column_types" =>             // line 11
($context["criteria_column_types"] ?? null)));
            // line 13
            echo "    ";
        } else {
            // line 14
            echo "        ";
            $this->loadTemplate("table/search/rows_normal.twig", "table/search/fields_table.twig", 14)->display(array("self" =>             // line 15
($context["self"] ?? null), "geom_column_flag" =>             // line 16
($context["geom_column_flag"] ?? null), "column_names" =>             // line 17
($context["column_names"] ?? null), "column_types" =>             // line 18
($context["column_types"] ?? null), "column_collations" =>             // line 19
($context["column_collations"] ?? null)));
            // line 21
            echo "    ";
        }
        // line 22
        echo "    </tbody>
</table>
";
    }

    public function getTemplateName()
    {
        return "table/search/fields_table.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 22,  50 => 21,  48 => 19,  47 => 18,  46 => 17,  45 => 16,  44 => 15,  42 => 14,  39 => 13,  37 => 11,  36 => 10,  35 => 9,  34 => 8,  32 => 7,  30 => 6,  27 => 5,  25 => 3,  24 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "table/search/fields_table.twig", "/home/travian/pma/templates/table/search/fields_table.twig");
    }
}
