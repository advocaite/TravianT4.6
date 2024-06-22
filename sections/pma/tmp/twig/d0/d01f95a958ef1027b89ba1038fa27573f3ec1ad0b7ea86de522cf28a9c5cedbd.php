<?php

/* display/export/options_output_charset.twig */
class __TwigTemplate_12559e71f4de784c674769811f0c60573b54b348db9e73febdf1f135631aa1bc extends Twig_Template
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
        echo "<li>
    <label for=\"select_charset\" class=\"desc\">
        ";
        // line 3
        echo _gettext("Character set of the file:");
        // line 4
        echo "    </label>
    <select id=\"select_charset\" name=\"charset\" size=\"1\">
        ";
        // line 6
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["encodings"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["charset"]) {
            // line 7
            echo "            <option value=\"";
            echo twig_escape_filter($this->env, $context["charset"], "html", null, true);
            echo "\"";
            // line 8
            if (((twig_test_empty(($context["export_charset"] ?? null)) && ($context["charset"] == "utf-8")) || (            // line 9
$context["charset"] == ($context["export_charset"] ?? null)))) {
                // line 10
                echo "                    selected";
            }
            // line 11
            echo ">";
            // line 12
            echo twig_escape_filter($this->env, $context["charset"], "html", null, true);
            // line 13
            echo "</option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['charset'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "    </select>
</li>
";
    }

    public function getTemplateName()
    {
        return "display/export/options_output_charset.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 15,  47 => 13,  45 => 12,  43 => 11,  40 => 10,  38 => 9,  37 => 8,  33 => 7,  29 => 6,  25 => 4,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "display/export/options_output_charset.twig", "/home/travian/pma/templates/display/export/options_output_charset.twig");
    }
}
