<?php

/* display/export/options_rows.twig */
class __TwigTemplate_b5b3ebcd20e088b254224fd859ead0104c948d637613a3446f81b5b13555d949 extends Twig_Template
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
        echo "<div class=\"exportoptions\" id=\"rows\">
    <h3>";
        // line 2
        echo _gettext("Rows:");
        echo "</h3>
    <ul>
        <li>
            <input type=\"radio\" name=\"allrows\" value=\"0\" id=\"radio_allrows_0\"";
        // line 6
        echo ((( !(null === ($context["allrows"] ?? null)) && (($context["allrows"] ?? null) == 0))) ? (" checked") : (""));
        echo ">
            <label for=\"radio_allrows_0\">";
        // line 7
        echo _gettext("Dump some row(s)");
        echo "</label>
            <ul>
                <li>
                    <label for=\"limit_to\">";
        // line 10
        echo _gettext("Number of rows:");
        echo "</label>
                    <input type=\"text\" id=\"limit_to\" name=\"limit_to\" size=\"5\" value=\"";
        // line 12
        ob_start();
        // line 13
        echo "                            ";
        if ( !(null === ($context["limit_to"] ?? null))) {
            // line 14
            echo "                                ";
            echo twig_escape_filter($this->env, ($context["limit_to"] ?? null), "html", null, true);
            echo "
                            ";
        } elseif (( !twig_test_empty(        // line 15
($context["unlim_num_rows"] ?? null)) && (($context["unlim_num_rows"] ?? null) != 0))) {
            // line 16
            echo "                                ";
            echo twig_escape_filter($this->env, ($context["unlim_num_rows"] ?? null), "html", null, true);
            echo "
                            ";
        } else {
            // line 18
            echo "                                ";
            echo twig_escape_filter($this->env, ($context["number_of_rows"] ?? null), "html", null, true);
            echo "
                            ";
        }
        // line 20
        echo "                        ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        echo "\" onfocus=\"this.select()\">
                </li>
                <li>
                    <label for=\"limit_from\">";
        // line 23
        echo _gettext("Row to begin at:");
        echo "</label>
                    <input type=\"text\" id=\"limit_from\" name=\"limit_from\" size=\"5\" value=\"";
        // line 25
        echo twig_escape_filter($this->env, (( !(null === ($context["limit_from"] ?? null))) ? (($context["limit_from"] ?? null)) : (0)), "html", null, true);
        echo "\" onfocus=\"this.select()\">
                </li>
            </ul>
        </li>
        <li>
            <input type=\"radio\" name=\"allrows\" value=\"1\" id=\"radio_allrows_1\"";
        // line 31
        echo ((((null === ($context["allrows"] ?? null)) || (($context["allrows"] ?? null) == 1))) ? (" checked") : (""));
        echo ">
             <label for=\"radio_allrows_1\">";
        // line 32
        echo _gettext("Dump all rows");
        echo "</label>
        </li>
    </ul>
</div>
";
    }

    public function getTemplateName()
    {
        return "display/export/options_rows.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  89 => 32,  85 => 31,  77 => 25,  73 => 23,  66 => 20,  60 => 18,  54 => 16,  52 => 15,  47 => 14,  44 => 13,  42 => 12,  38 => 10,  32 => 7,  28 => 6,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "display/export/options_rows.twig", "/home/travian/pma/templates/display/export/options_rows.twig");
    }
}
