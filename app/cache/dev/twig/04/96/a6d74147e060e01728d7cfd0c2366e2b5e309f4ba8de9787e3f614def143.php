<?php

/* TwigBundle:Exception:trace.txt.twig */
class __TwigTemplate_0496a6d74147e060e01728d7cfd0c2366e2b5e309f4ba8de9787e3f614def143 extends Twig_Template
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
        if ($this->getAttribute((isset($context["trace"]) ? $context["trace"] : $this->getContext($context, "trace")), "function")) {
            // line 2
            echo "    at ";
            echo twig_escape_filter($this->env, (($this->getAttribute((isset($context["trace"]) ? $context["trace"] : $this->getContext($context, "trace")), "class") . $this->getAttribute((isset($context["trace"]) ? $context["trace"] : $this->getContext($context, "trace")), "type")) . $this->getAttribute((isset($context["trace"]) ? $context["trace"] : $this->getContext($context, "trace")), "function")), "html", null, true);
            echo "(";
            echo twig_escape_filter($this->env, $this->env->getExtension('code')->formatArgsAsText($this->getAttribute((isset($context["trace"]) ? $context["trace"] : $this->getContext($context, "trace")), "args")), "html", null, true);
            echo ")
";
        } else {
            // line 4
            echo "    at n/a
";
        }
        // line 6
        if (($this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "file", array(), "any", true, true) && $this->getAttribute((isset($context["trace"]) ? $context["trace"] : null), "line", array(), "any", true, true))) {
            // line 7
            echo "        in ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["trace"]) ? $context["trace"] : $this->getContext($context, "trace")), "file"), "html", null, true);
            echo " line ";
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["trace"]) ? $context["trace"] : $this->getContext($context, "trace")), "line"), "html", null, true);
            echo "
";
        }
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:trace.txt.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  26 => 5,  87 => 20,  46 => 7,  44 => 10,  31 => 5,  25 => 3,  21 => 2,  89 => 20,  85 => 19,  75 => 17,  68 => 14,  56 => 9,  27 => 4,  24 => 4,  201 => 92,  199 => 91,  196 => 90,  187 => 84,  183 => 82,  173 => 74,  171 => 73,  158 => 67,  151 => 63,  142 => 59,  138 => 57,  136 => 56,  133 => 55,  121 => 46,  117 => 44,  112 => 42,  91 => 31,  86 => 28,  62 => 23,  51 => 15,  49 => 19,  19 => 1,  57 => 16,  389 => 160,  386 => 159,  378 => 157,  371 => 156,  367 => 155,  363 => 153,  358 => 151,  353 => 149,  345 => 147,  343 => 146,  340 => 145,  334 => 141,  331 => 140,  328 => 139,  326 => 138,  321 => 135,  309 => 129,  307 => 128,  302 => 125,  296 => 121,  293 => 120,  290 => 119,  288 => 118,  283 => 115,  281 => 114,  276 => 111,  274 => 110,  269 => 107,  265 => 105,  259 => 103,  255 => 101,  253 => 100,  235 => 89,  232 => 88,  227 => 86,  222 => 83,  210 => 77,  208 => 76,  189 => 66,  184 => 63,  175 => 58,  170 => 56,  166 => 71,  163 => 70,  155 => 47,  152 => 46,  144 => 42,  127 => 35,  109 => 27,  94 => 22,  82 => 19,  76 => 17,  61 => 12,  39 => 6,  36 => 7,  79 => 18,  72 => 16,  69 => 25,  54 => 21,  47 => 8,  42 => 14,  40 => 7,  37 => 10,  22 => 2,  164 => 58,  157 => 56,  145 => 46,  139 => 45,  131 => 42,  120 => 31,  115 => 43,  111 => 38,  108 => 37,  106 => 36,  101 => 24,  98 => 32,  92 => 21,  83 => 25,  80 => 19,  74 => 14,  66 => 15,  60 => 6,  55 => 13,  52 => 21,  50 => 8,  41 => 9,  32 => 12,  29 => 4,  462 => 202,  453 => 199,  449 => 198,  446 => 197,  441 => 196,  439 => 195,  431 => 189,  429 => 188,  422 => 184,  415 => 180,  408 => 176,  401 => 172,  394 => 168,  387 => 164,  380 => 158,  373 => 156,  361 => 152,  355 => 150,  351 => 141,  348 => 140,  342 => 137,  338 => 135,  335 => 134,  329 => 131,  325 => 129,  323 => 128,  320 => 127,  315 => 131,  312 => 130,  303 => 122,  300 => 121,  298 => 120,  289 => 113,  286 => 112,  278 => 106,  275 => 105,  270 => 102,  267 => 101,  262 => 98,  256 => 96,  248 => 97,  246 => 96,  241 => 93,  233 => 87,  229 => 87,  226 => 84,  220 => 81,  216 => 79,  213 => 78,  207 => 75,  203 => 73,  200 => 72,  197 => 69,  194 => 68,  191 => 67,  185 => 66,  181 => 65,  178 => 59,  176 => 63,  172 => 57,  168 => 72,  165 => 60,  162 => 57,  156 => 66,  153 => 56,  150 => 55,  147 => 43,  141 => 51,  134 => 39,  130 => 46,  123 => 47,  119 => 40,  116 => 39,  113 => 38,  105 => 40,  102 => 24,  99 => 23,  96 => 31,  90 => 20,  84 => 24,  81 => 23,  73 => 16,  70 => 15,  67 => 14,  64 => 12,  59 => 14,  53 => 12,  45 => 17,  43 => 8,  38 => 13,  35 => 7,  33 => 6,  30 => 3,);
    }
}
