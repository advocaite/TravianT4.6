<?php

/* mail/requestNewPassword.twig */
class __TwigTemplate_a503ca8076103d6a054457f8072af0a51d6ae5ae23541cc449ddfc95adb26faf extends Twig_Template
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
        echo "<!DOCTYPE html>
<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns:v=\"urn:schemas-microsoft-com:vml\"
      xmlns:o=\"urn:schemas-microsoft-com:office:office\">
<head><title></title>  <!--[if !mso]><!-- -->
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">  <!--<![endif]-->
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <style type=\"text/css\">  #outlook a {
            padding: 0;
        }

        .ReadMsgBody {
            width: 100%;
        }

        .ExternalClass {
            width: 100%;
        }

        .ExternalClass * {
            line-height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table, td {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        p {
            display: block;
            margin: 13px 0;
        }</style><!--[if !mso]><!-->
    <style type=\"text/css\">  @media only screen and (max-width: 480px) {
            @-ms-viewport {
                width: 320px;
            }    @viewport {
                width: 320px;
            }
        }</style><!--<![endif]--><!--[if mso]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml><![endif]--><!--[if lte mso 11]>
    <style type=\"text/css\">  .outlook-group-fix {
        width: 100% !important;
    }</style><![endif]--><!--[if !mso]><!-->
    <link href=\"https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700\" rel=\"stylesheet\" type=\"text/css\">
    <link href=\"https://fonts.googleapis.com/css?family=Merriweather\" rel=\"stylesheet\" type=\"text/css\">
    <style type=\"text/css\">        @import url(https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700);
        @import url(https://fonts.googleapis.com/css?family=Merriweather);    </style>  <!--<![endif]-->
    <style type=\"text/css\">  @media only screen and (min-width: 480px) {
            .mj-column-per-100 {
                width: 100% !important;
            }
        }</style>
</head>
<body style=\"background: #FFFFFF;\">
<div class=\"mj-container\" style=\"background-color:#FFFFFF;\"><!--[if mso | IE]>
    <table role=\"presentation\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\" align=\"center\"
           style=\"width:600px;\">
        <tr>
            <td style=\"line-height:0px;font-size:0px;mso-line-height-rule:exactly;\">      <![endif]-->
    <div style=\"margin:0px auto;max-width:600px;background:#ECECEC;\">
        <table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" style=\"font-size:0px;width:100%;background:#ECECEC;\"
               align=\"center\" border=\"0\">
            <tbody>
            <tr>
                <td style=\"text-align:center;vertical-align:top;direction:";
        // line 87
        echo twig_escape_filter($this->env, ($context["DIRECTION"] ?? null), "html", null, true);
        echo ";font-size:0px;padding:0px 0px 0px 0px;\">
                    <!--[if mso | IE]>
                    <table role=\"presentation\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                        <tr>
                            <td style=\"vertical-align:middle;width:600px;\">      <![endif]-->
                    <div class=\"mj-column-per-100 outlook-group-fix\"
                         style=\"vertical-align:middle;display:inline-block;direction:";
        // line 93
        echo twig_escape_filter($this->env, ($context["DIRECTION"] ?? null), "html", null, true);
        echo ";font-size:13px;text-align:";
        echo (((($context["DIRECTION"] ?? null) == "ltr")) ? ("left") : ("right"));
        echo ";width:100%;\">
                        <table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\" style=\"vertical-align:middle;\"
                               width=\"100%\" border=\"0\">
                            <tbody>
                            <tr>
                                <td style=\"word-wrap:break-word;font-size:0px;padding:0px 0px 0px 0px;\" align=\"center\">
                                    <table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\"
                                           style=\"border-collapse:collapse;border-spacing:0px;\" align=\"center\"
                                           border=\"0\">
                                        <tbody>
                                        <tr>
                                            <td style=\"width:600px;\"><a href=\"";
        // line 104
        echo twig_escape_filter($this->env, ($context["WEBSITE_INDEX_URL"] ?? null), "html", null, true);
        echo "\"
                                                                        target=\"_blank\"><img alt=\"\" title=\"\"
                                                                                             height=\"auto\"
                                                                                             src=\"";
        // line 107
        echo twig_escape_filter($this->env, ($context["GPACK_URL"] ?? null), "html", null, true);
        echo "newsletter/header_image.jpg\"
                                                                                             style=\"border:none;border-radius:0px;display:block;font-size:13px;outline:none;text-decoration:none;width:100%;height:auto;\"
                                                                                             width=\"600\"></a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style=\"word-wrap:break-word;font-size:0px;padding:0px 20px 0px 20px;\"
                                    align=\"center\">
                                    <div style=\"cursor:auto;color:#000000;font-family:Merriweather, Georgia, serif;font-size:10px;line-height:22px;text-align:center;\">
                                        <h1 style=\"font-family: &apos;Merriweather&apos;, Georgia, serif; font-size: 32px; color: #4E4E4E; line-height: 100%;\">
                                            <span style=\"font-size:22px;\">";
        // line 120
        echo sprintf(call_user_func_array($this->env->getFunction('T')->getCallable(), array("forgotPassword.youHaveRequestedANewPasswordFor")), ($context["WORLD_ID"] ?? null));
        echo "</span></h1></div>
                                </td>
                            </tr>
                            <tr>
                                <td style=\"word-wrap:break-word;font-size:0px;padding:0px 43px 0px 43px;\" align=\"";
        // line 124
        echo (((($context["DIRECTION"] ?? null) == "ltr")) ? ("left") : ("right"));
        echo "\">
                                    <div style=\"cursor:auto;color:#000000;font-family:Merriweather, Georgia, serif;font-size:10px;line-height:22px;text-align:";
        // line 125
        echo (((($context["DIRECTION"] ?? null) == "ltr")) ? ("left") : ("right"));
        echo ";\">
                                        <p><span style=\"font-size:16px;\">";
        // line 126
        echo call_user_func_array($this->env->getFunction('T')->getCallable(), array("forgotPassword.toResetYourAccountPassword"));
        echo "</span>
                                        </p></div>
                                </td>
                            </tr>
                            <tr>
                                <td style=\"word-wrap:break-word;font-size:0px;padding:32px 15px 32px 15px;padding-top:10px;padding-";
        // line 131
        echo (((($context["DIRECTION"] ?? null) == "ltr")) ? ("left") : ("right"));
        echo ":25px;\"
                                    align=\"center\">
                                    <table role=\"presentation\" cellpadding=\"0\" cellspacing=\"0\"
                                           style=\"border-collapse:separate;\" align=\"center\" border=\"0\">
                                        <tbody>
                                        <tr>
                                            <td style=\"border:none;border-radius:24px;color:#fff;cursor:auto;padding:10px 25px;\"
                                                align=\"center\" valign=\"middle\" bgcolor=\"#861500\"><a
                                                        href=\"";
        // line 139
        echo twig_escape_filter($this->env, ($context["CHANGE_PASSWORD_URL"] ?? null), "html", null, true);
        echo "\"
                                                        style=\"text-decoration:none;background:#861500;color:#fff;font-family:Ubuntu, Helvetica, Arial, sans-serif, Helvetica, Arial, sans-serif;font-size:24px;font-weight:normal;line-height:120%;text-transform:none;margin:0px;\"
                                                        target=\"_blank\">";
        // line 141
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('T')->getCallable(), array("forgotPassword.changePassword")), "html", null, true);
        echo "</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td style=\"word-wrap:break-word;font-size:0px;padding:0px 20px 0px 20px;\"
                                    align=\"center\">
                                    <div style=\"cursor:auto;color:#949494;font-family:Merriweather, Georgia, serif;font-size:10px;line-height:22px;text-align:center;\">
                                        <p><span style=\"font-size:12px;\">Copyright &#xA9; 2017&#xA0; Travian Speed Team, All rights reserved.&#xA0;<br>";
        // line 151
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('T')->getCallable(), array("You received this email because you registered on our website.")), "html", null, true);
        echo "&#xA0;</span>
                                        </p></div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--[if mso | IE]>      </td></tr></table>      <![endif]--></td>
            </tr>
            </tbody>
        </table>
    </div>
    <!--[if mso | IE]>      </td></tr></table>      <![endif]--></div>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "mail/requestNewPassword.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  206 => 151,  193 => 141,  188 => 139,  177 => 131,  169 => 126,  165 => 125,  161 => 124,  154 => 120,  138 => 107,  132 => 104,  116 => 93,  107 => 87,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "mail/requestNewPassword.twig", "/home/travian_global/users/turbotra/public_subdomains/api/include/Templates/mail/requestNewPassword.twig");
    }
}
