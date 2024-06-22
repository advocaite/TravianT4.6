<?php

/* display/export/method.twig */
class __TwigTemplate_ae7b31e651bc4940d611a065a0812832ccb35d2a7cc17462ff1bb21c5a7a26bd extends Twig_Template
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
        if ((($context["export_method"] ?? null) != "custom-no-form")) {
            // line 2
            echo "    <div class=\"exportoptions\" id=\"quick_or_custom\">
        <h3>";
            // line 3
            echo _gettext("Export method:");
            echo "</h3>
        <ul>
            <li>
                <input type=\"radio\" name=\"quick_or_custom\" value=\"quick\" id=\"radio_quick_export\"";
            // line 7
            echo (((($context["export_method"] ?? null) == "quick")) ? (" checked") : (""));
            echo ">
                <label for=\"radio_quick_export\">
                    ";
            // line 9
            echo _gettext("Quick - display only the minimal options");
            // line 10
            echo "                </label>
            </li>

            <li>
                <input type=\"radio\" name=\"quick_or_custom\" value=\"custom\" id=\"radio_custom_export\"";
            // line 15
            echo (((($context["export_method"] ?? null) == "custom")) ? (" checked") : (""));
            echo ">
                <label for=\"radio_custom_export\">
                    ";
            // line 17
            echo _gettext("Custom - display all possible options");
            // line 18
            echo "                </label>
            </li>
        </ul>
    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "display/export/method.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 18,  48 => 17,  43 => 15,  37 => 10,  35 => 9,  30 => 7,  24 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "display/export/method.twig", "/home/travian/pma/templates/display/export/method.twig");
    }
}
