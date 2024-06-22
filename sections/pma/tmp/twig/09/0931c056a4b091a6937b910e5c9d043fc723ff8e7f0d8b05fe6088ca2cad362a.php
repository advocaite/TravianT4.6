<?php

/* database/multi_table_query/form.twig */
class __TwigTemplate_dff838b1d55b25f177f64e7b075103c39cb4f9c37298437715f5deff68bbd121 extends Twig_Template
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
        echo PhpMyAdmin\Util::getDivForSliderEffect("query_div", _gettext("Query window"), "open");
        echo "
<form action=\"\" id=\"query_form\">
    <input type=\"hidden\" id=\"db_name\" value=\"";
        // line 3
        echo twig_escape_filter($this->env, ($context["db"] ?? null), "html", null, true);
        echo "\">
    <fieldset>
        ";
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["tables"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["table"]) {
            // line 6
            echo "            <div style=\"display:none\" id=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["table"], "hash", array()), "html", null, true);
            echo "\">
                <option value=\"*\">*</option>
                ";
            // line 8
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["table"], "columns", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["column"]) {
                // line 9
                echo "                    <option value=\"";
                echo twig_escape_filter($this->env, $context["column"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["column"], "html", null, true);
                echo "</option>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['column'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 11
            echo "            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['table'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "
        ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(range(0, ($context["default_no_of_columns"] ?? null)));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["id"]) {
            // line 15
            echo "            ";
            if (($context["id"] == 0)) {
                echo "<div style=\"display:none\" id=\"new_column_layout\">";
            }
            // line 16
            echo "            <fieldset style=\"display:inline\" class=\"column_details\">
                <select style=\"display:inline\" class=\"tableNameSelect\">
                    <option value=\"\">";
            // line 18
            echo _gettext("select table");
            echo "</option>
                    ";
            // line 19
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_array_keys_filter(($context["tables"] ?? null)));
            foreach ($context['_seq'] as $context["_key"] => $context["table"]) {
                // line 20
                echo "                        <option value=\"";
                echo twig_escape_filter($this->env, $context["table"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["table"], "html", null, true);
                echo "</option>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['table'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 22
            echo "                </select>
                <span>.</span>
                <select style=\"display:inline\" class=\"columnNameSelect\">
                    <option value=\"\">";
            // line 25
            echo _gettext("select column");
            echo "</option>
                </select>
                <br>
                <input type=\"checkbox\" checked=\"checked\" class=\"show_col\">
                <span>";
            // line 29
            echo _gettext("Show");
            echo "</span>
                <br>
                <input type=\"text\" placeholder=\"";
            // line 31
            echo _gettext("Table alias");
            echo "\" class=\"table_alias\">
                <input type=\"text\" placeholder=\"";
            // line 32
            echo _gettext("Column alias");
            echo "\" class=\"col_alias\">
                <br>
                <input type=\"checkbox\"
                    title=\"";
            // line 35
            echo _gettext("Use this column in criteria");
            echo "\"
                    class=\"criteria_col\">
                ";
            // line 37
            $this->loadTemplate("div_for_slider_effect.twig", "database/multi_table_query/form.twig", 37)->display(array_merge($context, array("id" => ("criteria_div" .             // line 38
$context["id"]), "initial_sliders_state" => "closed", "message" => _gettext("criteria"))));
            // line 42
            echo "                <div>
                    <table>

                        <tr class=\"sort_order\" style=\"background:none\">
                            <td>";
            // line 46
            echo _gettext("Sort");
            echo "</td>
                            <td><input type=\"radio\" name=\"sort[";
            // line 47
            echo twig_escape_filter($this->env, $context["id"], "html", null, true);
            echo "]\">";
            echo _gettext("Ascending");
            echo "</td>
                            <td><input type=\"radio\" name=\"sort[";
            // line 48
            echo twig_escape_filter($this->env, $context["id"], "html", null, true);
            echo "]\">";
            echo _gettext("Descending");
            echo "</td>
                        </tr>

                        <tr class=\"logical_operator\" style=\"background:none;display:none\">
                            <td>";
            // line 52
            echo _gettext("Add as");
            echo "</td>
                            <td>
                                <input type=\"radio\"
                                    name=\"logical_op[";
            // line 55
            echo twig_escape_filter($this->env, $context["id"], "html", null, true);
            echo "]\"
                                    value=\"AND\"
                                    class=\"logical_op\"
                                    checked=\"checked\">
                                AND
                            </td>
                            <td>
                                <input type=\"radio\"
                                    name=\"logical_op[";
            // line 63
            echo twig_escape_filter($this->env, $context["id"], "html", null, true);
            echo "]\"
                                    value=\"OR\"
                                    class=\"logical_op\">
                                OR
                            </td>
                        </tr>

                        <tr style=\"background:none\">
                            <td>Op </td>
                            <td>
                                <select class=\"criteria_op\">
                                    <option value=\"=\">=</option>
                                    <option value=\">\">&gt;</option>
                                    <option value=\">=\">&gt;=</option>
                                    <option value=\"<\">&lt;</option>
                                    <option value=\"<=\">&lt;=</option>
                                    <option value=\"!=\">!=</option>
                                    <option value=\"LIKE\">LIKE</option>
                                    <option value=\"LIKE %...%\">LIKE %...%</option>
                                    <option value=\"NOT LIKE\">NOT LIKE</option>
                                    <option value=\"IN (...)\">IN (...)</option>
                                    <option value=\"NOT IN (...)\">NOT IN (...)</option>
                                    <option value=\"BETWEEN\">BETWEEN</option>
                                    <option value=\"NOT BETWEEN\">NOT BETWEEN</option>
                                    <option value=\"IS NULL\">IS NULL</option>
                                    <option value=\"IS NOT NULL\">IS NOT NULL</option>
                                    <option value=\"REGEXP\">REGEXP</option>
                                    <option value=\"REGEXP ^...\$\">REGEXP ^...\$</option>
                                    <option value=\"NOT REGEXP\">NOT REGEXP</option>
                                </select>
                            </td>
                            <td>
                                <select class=\"criteria_rhs\">
                                    <option value=\"text\">";
            // line 96
            echo _gettext("Text");
            echo "</option>
                                    <option value=\"anotherColumn\">";
            // line 97
            echo _gettext("Another column");
            echo "</option>
                                </select>
                            </td>
                        </tr>

                        <tr class=\"rhs_table\" style=\"display:none;background:none\">
                            <td></td>
                            <td>
                                <select  class=\"tableNameSelect\">
                                    <option value=\"\">";
            // line 106
            echo _gettext("select table");
            echo "</option>
                                    ";
            // line 107
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_array_keys_filter(($context["tables"] ?? null)));
            foreach ($context['_seq'] as $context["_key"] => $context["table"]) {
                // line 108
                echo "                                        <option value=\"";
                echo twig_escape_filter($this->env, $context["table"], "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, $context["table"], "html", null, true);
                echo "</option>
                                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['table'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 110
            echo "                                </select><span>.</span>
                            </td>
                            <td>
                                <select style=\"display:inline\" class=\"columnNameSelect\">
                                    <option value=\"\">";
            // line 114
            echo _gettext("select column");
            echo "</option>
                                </select>
                            </td>
                        </tr>

                        <tr style=\"background:none\" class=\"rhs_text\">
                            <td></td>
                            <td colspan=\"2\">
                                <input type=\"text\"
                                    style=\"width:91%\"
                                    class=\"rhs_text_val\"
                                    placeholder=\"";
            // line 125
            echo _gettext("Enter criteria as free text");
            echo "\">
                            </td>
                        </tr>

                        </table>
                    </div>
                </div>
                <a href=\"#\"
                    title=\"";
            // line 133
            echo _gettext("Remove this column");
            echo "\"
                    style=\"float:right;color:red\"
                    class=\"removeColumn\">
                    X
                </a>
            </fieldset>
            ";
            // line 139
            if (($context["id"] == 0)) {
                echo "</div>";
            }
            // line 140
            echo "        ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['id'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 141
        echo "
        <fieldset style=\"display:inline\">
            <input type=\"button\" value=\"";
        // line 143
        echo _gettext("+ Add column");
        echo "\" id=\"add_column_button\">
        </fieldset>

        <fieldset>
            ";
        // line 147
        ob_start();
        // line 148
        echo "                <textarea id=\"MultiSqlquery\"
                    cols=\"80\"
                    rows=\"4\"
                    style=\"float:left\"
                    name=\"sql_query\"
                    dir=\"ltr\">
                </textarea>
            ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        // line 156
        echo "        </fieldset>
    </fieldset>

    <fieldset class=\"tblFooters\">
        <input type=\"button\" id=\"update_query_button\" value=\"";
        // line 160
        echo _gettext("Update query");
        echo "\">
        <input type=\"button\" id=\"submit_query\" value=\"";
        // line 161
        echo _gettext("Submit query");
        echo "\">
    </fieldset>
</form>
</div>";
        // line 165
        echo "<div id=\"sql_results\"></div>
";
    }

    public function getTemplateName()
    {
        return "database/multi_table_query/form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  354 => 165,  348 => 161,  344 => 160,  338 => 156,  328 => 148,  326 => 147,  319 => 143,  315 => 141,  301 => 140,  297 => 139,  288 => 133,  277 => 125,  263 => 114,  257 => 110,  246 => 108,  242 => 107,  238 => 106,  226 => 97,  222 => 96,  186 => 63,  175 => 55,  169 => 52,  160 => 48,  154 => 47,  150 => 46,  144 => 42,  142 => 38,  141 => 37,  136 => 35,  130 => 32,  126 => 31,  121 => 29,  114 => 25,  109 => 22,  98 => 20,  94 => 19,  90 => 18,  86 => 16,  81 => 15,  64 => 14,  61 => 13,  54 => 11,  43 => 9,  39 => 8,  33 => 6,  29 => 5,  24 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "database/multi_table_query/form.twig", "/home/travian/pma/templates/database/multi_table_query/form.twig");
    }
}
