<?php

/* privileges/add_privileges_database.twig */
class __TwigTemplate_8e836c76c986ce88f95b3bffa6d6d1efd7a20036b2821cdcb6194c90c8ef1049 extends Twig_Template
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
        echo "<label for=\"text_dbname\">";
        echo _gettext("Add privileges on the following database(s):");
        echo "</label>";
        // line 3
        if ( !twig_test_empty(($context["databases"] ?? null))) {
            // line 4
            echo "    <select name=\"pred_dbname[]\" multiple=\"multiple\">
        ";
            // line 5
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["databases"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["database"]) {
                // line 6
                echo "            <option value=\"";
                echo twig_escape_filter($this->env, PhpMyAdmin\Util::escapeMysqlWildcards($context["database"]), "html", null, true);
                echo "\">
                ";
                // line 7
                echo twig_escape_filter($this->env, $context["database"], "html", null, true);
                echo "
            </option>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['database'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 10
            echo "    </select>
";
        }
        // line 13
        echo "<input type=\"text\" id=\"text_dbname\" name=\"dbname\" />
";
        // line 14
        echo PhpMyAdmin\Util::showHint(_gettext("Wildcards % and _ should be escaped with a \\ to use them literally."));
        echo "
";
    }

    public function getTemplateName()
    {
        return "privileges/add_privileges_database.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  53 => 14,  50 => 13,  46 => 10,  37 => 7,  32 => 6,  28 => 5,  25 => 4,  23 => 3,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "privileges/add_privileges_database.twig", "/home/travian/pma/templates/privileges/add_privileges_database.twig");
    }
}
