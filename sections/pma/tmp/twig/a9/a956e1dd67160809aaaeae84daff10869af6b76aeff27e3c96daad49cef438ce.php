<?php

/* export/alias_add.twig */
class __TwigTemplate_e391a95cf469ad55694b4f760c723962d708994b30f60ddd7b7422008059a111 extends Twig_Template
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
        echo "<table>
    <thead>
        <tr>
            <th colspan=\"4\">";
        // line 4
        echo _gettext("Define new aliases");
        echo "</th>
        </tr>
    </thead>
    <tr>
        <td>
            <label>";
        // line 9
        echo _gettext("Select database:");
        echo "</label>
        </td>
        <td>
            <select id=\"db_alias_select\"><option value=\"\"></option></select>
        </td>
        <td>
            <input id=\"db_alias_name\" placeholder=\"";
        // line 15
        echo _gettext("New database name");
        echo "\" disabled=\"1\" />
        </td>
        <td>
            <button id=\"db_alias_button\" class=\"ui-button ui-corner-all ui-widget\" disabled=\"1\">";
        // line 18
        echo _gettext("Add");
        echo "</button>
        </td>
    </tr>
    <tr>
        <td>
            <label>";
        // line 23
        echo _gettext("Select table:");
        echo "</label>
        </td>
        <td>
            <select id=\"table_alias_select\"><option value=\"\"></option></select>
        </td>
        <td>
            <input id=\"table_alias_name\" placeholder=\"";
        // line 29
        echo _gettext("New table name");
        echo "\" disabled=\"1\" />
        </td>
        <td>
            <button id=\"table_alias_button\" class=\"ui-button ui-corner-all ui-widget\" disabled=\"1\">";
        // line 32
        echo _gettext("Add");
        echo "</button>
        </td>
    </tr>
    <tr>
        <td>
            <label>";
        // line 37
        echo _gettext("Select column:");
        echo "</label>
        </td>
        <td>
            <select id=\"column_alias_select\"><option value=\"\"></option></select>
        </td>
        <td>
            <input id=\"column_alias_name\" placeholder=\"";
        // line 43
        echo _gettext("New column name");
        echo "\" disabled=\"1\" />
        </td>
        <td>
            <button id=\"column_alias_button\" class=\"ui-button ui-corner-all ui-widget\" disabled=\"1\">";
        // line 46
        echo _gettext("Add");
        echo "</button>
        </td>
    </tr>
</table>
";
    }

    public function getTemplateName()
    {
        return "export/alias_add.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 46,  87 => 43,  78 => 37,  70 => 32,  64 => 29,  55 => 23,  47 => 18,  41 => 15,  32 => 9,  24 => 4,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "export/alias_add.twig", "/home/travian/pma/templates/export/alias_add.twig");
    }
}
