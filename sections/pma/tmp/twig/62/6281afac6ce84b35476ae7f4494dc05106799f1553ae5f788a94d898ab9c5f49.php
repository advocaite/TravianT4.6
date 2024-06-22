<?php

/* privileges/privileges_summary_row.twig */
class __TwigTemplate_abd413a20d670cd85ebd07cdc24cf588eefc1f713cea1f659f68f0274a593c5e extends Twig_Template
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
        echo "<tr>
    <td>";
        // line 2
        echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
        echo "</td>
    <td><code>";
        // line 3
        echo ($context["privileges"] ?? null);
        echo "</code></td>
    <td>";
        // line 4
        echo twig_escape_filter($this->env, ((($context["grant"] ?? null)) ? (_gettext("Yes")) : (_gettext("No"))), "html", null, true);
        echo "</td>

    ";
        // line 6
        if ((($context["type"] ?? null) == "database")) {
            // line 7
            echo "        <td>";
            echo twig_escape_filter($this->env, ((($context["table_privs"] ?? null)) ? (_gettext("Yes")) : (_gettext("No"))), "html", null, true);
            echo "</td>
    ";
        } elseif ((        // line 8
($context["type"] ?? null) == "table")) {
            // line 9
            echo "        <td>";
            echo twig_escape_filter($this->env, ((($context["column_privs"] ?? null)) ? (_gettext("Yes")) : (_gettext("No"))), "html", null, true);
            echo "</td>
    ";
        }
        // line 11
        echo "
    <td>";
        // line 12
        echo ($context["edit_link"] ?? null);
        echo "</td>
    <td>";
        // line 13
        echo ($context["revoke_link"] ?? null);
        echo "</td>
</tr>
";
    }

    public function getTemplateName()
    {
        return "privileges/privileges_summary_row.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 13,  53 => 12,  50 => 11,  44 => 9,  42 => 8,  37 => 7,  35 => 6,  30 => 4,  26 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "privileges/privileges_summary_row.twig", "/home/travian/pma/templates/privileges/privileges_summary_row.twig");
    }
}
