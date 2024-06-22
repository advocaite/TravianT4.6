<?php

/* table/search/form_tag.twig */
class __TwigTemplate_3f3fb4a0b37a8391c2e1787907061b805fc0c196d9ff19d2fdec1588b09c02c7 extends Twig_Template
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
        echo "<form method=\"post\" action=\"";
        echo twig_escape_filter($this->env, ($context["script_name"] ?? null), "html", null, true);
        echo "\" name=\"insertForm\" id=\"";
        echo twig_escape_filter($this->env, ($context["form_id"] ?? null), "html", null, true);
        echo "\" class=\"ajax lock-page\">
    ";
        // line 2
        echo PhpMyAdmin\Url::getHiddenInputs(($context["db"] ?? null), ($context["table"] ?? null));
        echo "
    <input type=\"hidden\" name=\"goto\" value=\"";
        // line 3
        echo twig_escape_filter($this->env, ($context["goto"] ?? null), "html", null, true);
        echo "\" />
    <input type=\"hidden\" name=\"back\" value=\"";
        // line 4
        echo twig_escape_filter($this->env, ($context["script_name"] ?? null), "html", null, true);
        echo "\" />
";
    }

    public function getTemplateName()
    {
        return "table/search/form_tag.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  34 => 4,  30 => 3,  26 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "table/search/form_tag.twig", "/home/travian/pma/templates/table/search/form_tag.twig");
    }
}
