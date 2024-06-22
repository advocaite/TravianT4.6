<?php

/* view_create.twig */
class __TwigTemplate_dd9f476a50d0e8b1774dc79ff6188d19729067d11cd839b30c4e9bf1659cbe73 extends Twig_Template
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
        echo "<!-- CREATE VIEW options -->
<div id=\"div_view_options\">
    <form method=\"post\" action=\"view_create.php\">
    ";
        // line 4
        echo PhpMyAdmin\Url::getHiddenInputs(($context["url_params"] ?? null));
        echo "
    <fieldset>
        <legend>
            ";
        // line 7
        if (($context["ajax_dialog"] ?? null)) {
            // line 8
            echo "                ";
            echo _gettext("Details");
            // line 9
            echo "            ";
        } else {
            // line 10
            echo "                ";
            if (($this->getAttribute(($context["view"] ?? null), "operation", array(), "array") == "create")) {
                // line 11
                echo "                    ";
                echo _gettext("Create view");
                // line 12
                echo "                ";
            } else {
                // line 13
                echo "                    ";
                echo _gettext("Edit view");
                // line 14
                echo "                ";
            }
            // line 15
            echo "            ";
        }
        // line 16
        echo "        </legend>
        <table class=\"rte_table\">
            ";
        // line 18
        if (($this->getAttribute(($context["view"] ?? null), "operation", array(), "array") == "create")) {
            // line 19
            echo "                <tr>
                    <td class=\"nowrap\"><label for=\"or_replace\">OR REPLACE</label></td>
                    <td>
                        <input type=\"checkbox\" name=\"view[or_replace]\" id=\"or_replace\"
                            ";
            // line 23
            if ($this->getAttribute(($context["view"] ?? null), "or_replace", array(), "array")) {
                echo " checked=\"checked\" ";
            }
            // line 24
            echo "                            value=\"1\" />
                    </td>
                </tr>
            ";
        }
        // line 28
        echo "
            <tr>
                <td class=\"nowrap\"><label for=\"algorithm\">ALGORITHM</label></td>
                <td>
                    <select name=\"view[algorithm]\" id=\"algorithm\">
                        ";
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["view_algorithm_options"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
            // line 34
            echo "                            <option value=\"";
            echo twig_escape_filter($this->env, $context["option"], "html", null, true);
            echo "\"
                                ";
            // line 35
            if (($this->getAttribute(($context["view"] ?? null), "algorithm", array(), "array") == $context["option"])) {
                // line 36
                echo "                                    selected=\"selected\"
                                ";
            }
            // line 38
            echo "                            >";
            echo twig_escape_filter($this->env, $context["option"], "html", null, true);
            echo "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 40
        echo "                    </select>
                </td>
            </tr>

            <tr>
                <td class=\"nowrap\">";
        // line 45
        echo _gettext("Definer");
        echo "</td>
                <td><input type=\"text\" maxlength=\"100\" size=\"50\" name=\"view[definer]\" value=\"";
        // line 46
        echo twig_escape_filter($this->env, $this->getAttribute(($context["view"] ?? null), "definer", array(), "array"), "html", null, true);
        echo "\" /></td>
            </tr>

            <tr>
                <td class=\"nowrap\">SQL SECURITY</td>
                <td>
                    <select name=\"view[sql_security]\">
                        <option value=\"\"></option>
                        ";
        // line 54
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["view_security_options"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
            // line 55
            echo "                            <option value=\"";
            echo twig_escape_filter($this->env, $context["option"], "html", null, true);
            echo "\"
                                ";
            // line 56
            if (($context["option"] == $this->getAttribute(($context["view"] ?? null), "sql_security", array(), "array"))) {
                echo " selected=\"selected\" ";
            }
            // line 57
            echo "                            >";
            echo twig_escape_filter($this->env, $context["option"], "html", null, true);
            echo "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 59
        echo "                    </select>
                </td>
            </tr>

            ";
        // line 63
        if (($this->getAttribute(($context["view"] ?? null), "operation", array(), "array") == "create")) {
            // line 64
            echo "                <tr>
                    <td class=\"nowrap\">";
            // line 65
            echo _gettext("VIEW name");
            echo "</td>
                    <td>
                        <input type=\"text\" size=\"20\" name=\"view[name]\" onfocus=\"this.select()\" maxlength=\"64\" value=\"";
            // line 67
            echo twig_escape_filter($this->env, $this->getAttribute(($context["view"] ?? null), "name", array(), "array"), "html", null, true);
            echo "\" />
                    </td>
                </tr>
            ";
        } else {
            // line 71
            echo "                <tr>
                    <td>
                        <input type=\"hidden\" name=\"view[name]\" value=\"";
            // line 73
            echo twig_escape_filter($this->env, $this->getAttribute(($context["view"] ?? null), "name", array(), "array"), "html", null, true);
            echo "\" />
                    </td>
                </tr>
            ";
        }
        // line 77
        echo "
            <tr>
                <td class=\"nowrap\">";
        // line 79
        echo _gettext("Column names");
        echo "</td>
                <td>
                    <input type=\"text\" maxlength=\"100\" size=\"50\" name=\"view[column_names]\" onfocus=\"this.select()\"  value=\"";
        // line 81
        echo twig_escape_filter($this->env, $this->getAttribute(($context["view"] ?? null), "column_names", array(), "array"), "html", null, true);
        echo "\" />
                </td>
            </tr>

            <tr>
                <td class=\"nowrap\">AS</td>
                <td>
                    <textarea name=\"view[as]\" rows=\"15\" cols=\"40\" dir=\"";
        // line 88
        echo twig_escape_filter($this->env, ($context["text_dir"] ?? null), "html", null, true);
        echo "\" onclick=\"selectContent(this, sql_box_locked, true)\">";
        echo twig_escape_filter($this->env, $this->getAttribute(($context["view"] ?? null), "as", array(), "array"), "html", null, true);
        echo "</textarea><br/>
                    <input type=\"button\" value=\"Format\" id=\"format\" class=\"button sqlbutton\">
                    <span id=\"querymessage\"></span>
                </td>
            </tr>

            <tr>
                <td class=\"nowrap\">WITH CHECK OPTION</td>
                <td>
                    <select name=\"view[with]\">
                        <option value=\"\"></option>
                        ";
        // line 99
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["view_with_options"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
            // line 100
            echo "                            <option value=\"";
            echo twig_escape_filter($this->env, $context["option"], "html", null, true);
            echo "\"
                                ";
            // line 101
            if (($context["option"] == $this->getAttribute(($context["view"] ?? null), "with", array(), "array"))) {
                echo " selected=\"selected\" ";
            }
            // line 102
            echo "                            >";
            echo twig_escape_filter($this->env, $context["option"], "html", null, true);
            echo "</option>
                        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 104
        echo "                    </select>
                </td>
            </tr>

        </table>
    </fieldset>

    ";
        // line 111
        if (($context["ajax_dialog"] ?? null)) {
            // line 112
            echo "        <fieldset class=\"tblFooters\">
            <input type=\"hidden\" name=\"";
            // line 113
            echo ((($this->getAttribute(($context["view"] ?? null), "operation", array(), "array") == "create")) ? ("createview") : ("alterview"));
            echo "\" value=\"1\" />
            <input type=\"submit\" name=\"\" value=\"";
            // line 114
            echo _gettext("Go");
            echo "\" />
        </fieldset>
    ";
        } else {
            // line 117
            echo "        <input type=\"hidden\" name=\"";
            echo ((($this->getAttribute(($context["view"] ?? null), "operation", array(), "array") == "create")) ? ("createview") : ("alterview"));
            echo "\" value=\"1\" />
        <input type=\"hidden\" name=\"ajax_dialog\" value=\"1\" />
        <input type=\"hidden\" name=\"ajax_request\" value=\"1\" />
        <input type=\"submit\" name=\"\" value=\"";
            // line 120
            echo _gettext("Go");
            echo "\" />
    ";
        }
        // line 122
        echo "
    </form>
</div>
";
    }

    public function getTemplateName()
    {
        return "view_create.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  280 => 122,  275 => 120,  268 => 117,  262 => 114,  258 => 113,  255 => 112,  253 => 111,  244 => 104,  235 => 102,  231 => 101,  226 => 100,  222 => 99,  206 => 88,  196 => 81,  191 => 79,  187 => 77,  180 => 73,  176 => 71,  169 => 67,  164 => 65,  161 => 64,  159 => 63,  153 => 59,  144 => 57,  140 => 56,  135 => 55,  131 => 54,  120 => 46,  116 => 45,  109 => 40,  100 => 38,  96 => 36,  94 => 35,  89 => 34,  85 => 33,  78 => 28,  72 => 24,  68 => 23,  62 => 19,  60 => 18,  56 => 16,  53 => 15,  50 => 14,  47 => 13,  44 => 12,  41 => 11,  38 => 10,  35 => 9,  32 => 8,  30 => 7,  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "view_create.twig", "/home/travian/pma/templates/view_create.twig");
    }
}
