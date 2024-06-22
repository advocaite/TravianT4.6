<?php

/* toggle_button.twig */
class __TwigTemplate_282e3a01a50b87bf5e88b79a85b6e7051bc1bc711566a020b3a3ff47676c5b0c extends Twig_Template
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
        echo "<div class='wrapper toggleAjax hide'>
    <div class='toggleButton'>
        <div title=\"";
        // line 3
        echo _gettext("Click to toggle");
        echo "\" class='container ";
        echo twig_escape_filter($this->env, ($context["state"] ?? null), "html", null, true);
        echo "'>
            <img src=\"";
        // line 4
        echo twig_escape_filter($this->env, ($context["pma_theme_image"] ?? null), "html", null, true);
        echo "toggle-";
        echo twig_escape_filter($this->env, ($context["text_dir"] ?? null), "html", null, true);
        echo ".png\" alt='' />
            <table class='nospacing nopadding'>
                <tbody>
                    <tr>
                        <td class='toggleOn'>
                            <span class='hide'>";
        // line 9
        echo ($context["link_on"] ?? null);
        echo "</span>
                            <div>";
        // line 10
        echo twig_escape_filter($this->env, ($context["toggle_on"] ?? null), "html", null, true);
        echo "</div>
                        </td>
                        <td><div>&nbsp;</div></td>
                        <td class='toggleOff'>
                            <span class='hide'>";
        // line 14
        echo ($context["link_off"] ?? null);
        echo "</span>
                            <div>";
        // line 15
        echo twig_escape_filter($this->env, ($context["toggle_off"] ?? null), "html", null, true);
        echo "</div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <span class='hide callback'>";
        // line 20
        echo twig_escape_filter($this->env, ($context["callback"] ?? null), "html", null, true);
        echo "</span>
            <span class='hide text_direction'>";
        // line 21
        echo twig_escape_filter($this->env, ($context["text_dir"] ?? null), "html", null, true);
        echo "</span>
        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "toggle_button.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 21,  62 => 20,  54 => 15,  50 => 14,  43 => 10,  39 => 9,  29 => 4,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "toggle_button.twig", "/home/travian/pma/templates/toggle_button.twig");
    }
}
