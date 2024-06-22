<?php

/* display/export/select_options.twig */
class __TwigTemplate_a19f161aef3bb7779a83ed06e470450511db7cfae0696b496b0d3ca497bee03a extends Twig_Template
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
        echo "<div>
    <p>
        <a href=\"#\" onclick=\"setSelectOptions('dump', 'db_select[]', true); return false;\">
            ";
        // line 4
        echo _gettext("Select all");
        // line 5
        echo "        </a>
        /
        <a href=\"#\" onclick=\"setSelectOptions('dump', 'db_select[]', false); return false;\">
            ";
        // line 8
        echo _gettext("Unselect all");
        // line 9
        echo "        </a>
    </p>

    <select name=\"db_select[]\" id=\"db_select\" size=\"10\" multiple>
        ";
        // line 13
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["databases"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["database"]) {
            // line 14
            echo "            <option value=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["database"], "name", array()), "html", null, true);
            echo "\"";
            echo (($this->getAttribute($context["database"], "is_selected", array())) ? (" selected") : (""));
            echo ">
                ";
            // line 15
            echo twig_escape_filter($this->env, $this->getAttribute($context["database"], "name", array()), "html", null, true);
            echo "
            </option>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['database'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "    </select>
</div>
";
    }

    public function getTemplateName()
    {
        return "display/export/select_options.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 18,  50 => 15,  43 => 14,  39 => 13,  33 => 9,  31 => 8,  26 => 5,  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "display/export/select_options.twig", "/home/travian/pma/templates/display/export/select_options.twig");
    }
}
