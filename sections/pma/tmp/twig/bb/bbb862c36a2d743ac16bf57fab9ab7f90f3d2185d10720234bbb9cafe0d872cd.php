<?php

/* table/structure/partition_definition_form.twig */
class __TwigTemplate_44dd38dee324ed232266bb89fa44fc7426f04eaad3c3f20e120aaa7407469164 extends Twig_Template
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
        echo "<form action=\"tbl_structure.php\" method=\"post\">
    ";
        // line 2
        echo PhpMyAdmin\Url::getHiddenInputs(($context["db"] ?? null), ($context["table"] ?? null));
        echo "
    <input type=\"hidden\" name=\"edit_partitioning\" value=\"true\" />

    <fieldset>
        <legend>";
        // line 6
        echo _gettext("Edit partitioning");
        echo "</legend>
        ";
        // line 7
        $this->loadTemplate("columns_definitions/partitions.twig", "table/structure/partition_definition_form.twig", 7)->display(array("partition_details" =>         // line 8
($context["partition_details"] ?? null)));
        // line 10
        echo "    </fieldset>
    <fieldset class=\"tblFooters\">
        <input type=\"submit\" name=\"save_partitioning\" value=\"";
        // line 12
        echo _gettext("Save");
        echo "\">
    </fieldset>
</form>
";
    }

    public function getTemplateName()
    {
        return "table/structure/partition_definition_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 12,  36 => 10,  34 => 8,  33 => 7,  29 => 6,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "table/structure/partition_definition_form.twig", "/home/travian/pma/templates/table/structure/partition_definition_form.twig");
    }
}
