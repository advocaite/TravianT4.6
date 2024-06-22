<?php

/* table/search/options.twig */
class __TwigTemplate_e4363740831f0b565a3b1310f058ccc1c33d6e57d790776615783bf484a55051 extends Twig_Template
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
        echo PhpMyAdmin\Util::getDivForSliderEffect("searchoptions", _gettext("Options"));
        echo "

";
        // line 4
        echo "<fieldset id=\"fieldset_select_fields\">
    <legend>
        ";
        // line 6
        echo _gettext("Select columns (at least one):");
        // line 7
        echo "    </legend>
    <select name=\"columnsToDisplay[]\"
        size=\"";
        // line 9
        echo twig_escape_filter($this->env, min(twig_length_filter($this->env, ($context["column_names"] ?? null)), 10), "html", null, true);
        echo "\"
        multiple=\"multiple\">
        ";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["column_names"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["each_field"]) {
            // line 12
            echo "            <option value=\"";
            echo twig_escape_filter($this->env, $context["each_field"], "html", null, true);
            echo "\"
                selected=\"selected\">
                ";
            // line 14
            echo twig_escape_filter($this->env, $context["each_field"], "html", null, true);
            echo "
            </option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['each_field'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "    </select>
    <input type=\"checkbox\" name=\"distinct\" value=\"DISTINCT\" id=\"oDistinct\" />
    <label for=\"oDistinct\">DISTINCT</label>
</fieldset>

";
        // line 23
        echo "<fieldset id=\"fieldset_search_conditions\">
    <legend>
        <em>";
        // line 25
        echo _gettext("Or");
        echo "</em>
        ";
        // line 26
        echo _gettext("Add search conditions (body of the \"where\" clause):");
        // line 27
        echo "    </legend>
    ";
        // line 28
        echo PhpMyAdmin\Util::showMySQLDocu("Functions");
        echo "
    <input type=\"text\" name=\"customWhereClause\" class=\"textfield\" size=\"64\" />
</fieldset>

";
        // line 33
        echo "<fieldset id=\"fieldset_limit_rows\">
    <legend>";
        // line 34
        echo _gettext("Number of rows per page");
        echo "</legend>
    <input type=\"number\"
        name=\"session_max_rows\"
        required=\"required\"
        min=\"1\"
        value=\"";
        // line 39
        echo twig_escape_filter($this->env, ($context["max_rows"] ?? null), "html", null, true);
        echo "\"
        class=\"textfield\" />
</fieldset>

";
        // line 44
        echo "<fieldset id=\"fieldset_display_order\">
    <legend>";
        // line 45
        echo _gettext("Display order:");
        echo "</legend>
    <select name=\"orderByColumn\"><option value=\"--nil--\"></option>
        ";
        // line 47
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["column_names"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["each_field"]) {
            // line 48
            echo "            <option value=\"";
            echo twig_escape_filter($this->env, $context["each_field"], "html", null, true);
            echo "\">
                ";
            // line 49
            echo twig_escape_filter($this->env, $context["each_field"], "html", null, true);
            echo "
            </option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['each_field'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        echo "    </select>

    ";
        // line 54
        echo PhpMyAdmin\Util::getRadioFields("order", array("ASC" => _gettext("Ascending"), "DESC" => _gettext("Descending")), "ASC", false, true, "formelement");
        // line 64
        echo "

</fieldset>
<div class=\"clearfloat\"></div>
";
    }

    public function getTemplateName()
    {
        return "table/search/options.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  135 => 64,  133 => 54,  129 => 52,  120 => 49,  115 => 48,  111 => 47,  106 => 45,  103 => 44,  96 => 39,  88 => 34,  85 => 33,  78 => 28,  75 => 27,  73 => 26,  69 => 25,  65 => 23,  58 => 17,  49 => 14,  43 => 12,  39 => 11,  34 => 9,  30 => 7,  28 => 6,  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "table/search/options.twig", "/home/travian/pma/templates/table/search/options.twig");
    }
}
