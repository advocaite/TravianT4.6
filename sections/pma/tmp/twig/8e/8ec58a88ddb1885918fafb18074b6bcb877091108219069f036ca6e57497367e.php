<?php

/* database/search/selection_form.twig */
class __TwigTemplate_5f54eed23bd12418d292385c60aa151094ce462cce9ece20fd3d17570ff20d45 extends Twig_Template
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
        echo "<a id=\"db_search\"></a>
<form id=\"db_search_form\" method=\"post\" action=\"db_search.php\" name=\"db_search\" class=\"ajax lock-page\">
    ";
        // line 3
        echo PhpMyAdmin\Url::getHiddenInputs(($context["db"] ?? null));
        echo "
    <fieldset>
        <legend>";
        // line 5
        echo _gettext("Search in database");
        echo "</legend>
        <p>
            <label for=\"criteriaSearchString\" class=\"displayblock\">
                ";
        // line 8
        echo _gettext("Words or values to search for (wildcard: \"%\"):");
        // line 9
        echo "            </label>
            <input id=\"criteriaSearchString\" name=\"criteriaSearchString\" class=\"all85\" type=\"text\" value=\"";
        // line 11
        echo twig_escape_filter($this->env, ($context["criteria_search_string"] ?? null), "html", null, true);
        echo "\">
        </p>

        <fieldset>
            <legend>";
        // line 15
        echo _gettext("Find:");
        echo "</legend>
            ";
        // line 17
        echo "            ";
        // line 19
        echo "            ";
        echo PhpMyAdmin\Util::getRadioFields("criteriaSearchType",         // line 21
($context["choices"] ?? null),         // line 22
($context["criteria_search_type"] ?? null), true, false);
        // line 25
        echo "
        </fieldset>

        <fieldset>
            <legend>";
        // line 29
        echo _gettext("Inside tables:");
        echo "</legend>
            <p>
                <a href=\"#\" onclick=\"setSelectOptions('db_search', 'criteriaTables[]', true); return false;\">
                    ";
        // line 32
        echo _gettext("Select all");
        // line 33
        echo "                </a> /
                <a href=\"#\" onclick=\"setSelectOptions('db_search', 'criteriaTables[]', false); return false;\">
                    ";
        // line 35
        echo _gettext("Unselect all");
        // line 36
        echo "                </a>
            </p>
            <select name=\"criteriaTables[]\" multiple>
                ";
        // line 39
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["tables_names_only"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["each_table"]) {
            // line 40
            echo "                    <option value=\"";
            echo twig_escape_filter($this->env, $context["each_table"], "html", null, true);
            echo "\"";
            // line 41
            echo ((twig_in_filter($context["each_table"], ($context["criteria_tables"] ?? null))) ? (" selected") : (""));
            echo ">
                        ";
            // line 42
            echo twig_escape_filter($this->env, $context["each_table"], "html", null, true);
            echo "
                    </option>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['each_table'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 45
        echo "            </select>
        </fieldset>

        <p>
            ";
        // line 50
        echo "            <label for=\"criteriaColumnName\" class=\"displayblock\">
                ";
        // line 51
        echo _gettext("Inside column:");
        // line 52
        echo "            </label>
            <input id=\"criteriaColumnName\" type=\"text\" name=\"criteriaColumnName\" class=\"all85\" value=\"";
        // line 54
        echo twig_escape_filter($this->env, (( !twig_test_empty(($context["criteria_column_name"] ?? null))) ? (($context["criteria_column_name"] ?? null)) : ("")), "html", null, true);
        echo "\">
        </p>
    </fieldset>
    <fieldset class=\"tblFooters\">
        <input type=\"submit\" name=\"submit_search\" value=\"";
        // line 58
        echo _gettext("Go");
        echo "\" id=\"buttonGo\">
    </fieldset>
</form>
<div id=\"togglesearchformdiv\">
    <a id=\"togglesearchformlink\"></a>
</div>
";
    }

    public function getTemplateName()
    {
        return "database/search/selection_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  124 => 58,  117 => 54,  114 => 52,  112 => 51,  109 => 50,  103 => 45,  94 => 42,  90 => 41,  86 => 40,  82 => 39,  77 => 36,  75 => 35,  71 => 33,  69 => 32,  63 => 29,  57 => 25,  55 => 22,  54 => 21,  52 => 19,  50 => 17,  46 => 15,  39 => 11,  36 => 9,  34 => 8,  28 => 5,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "database/search/selection_form.twig", "/home/travian/pma/templates/database/search/selection_form.twig");
    }
}
