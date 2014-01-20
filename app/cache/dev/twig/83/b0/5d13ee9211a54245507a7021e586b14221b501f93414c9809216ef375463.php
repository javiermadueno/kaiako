<?php

/* @WebProfiler/Collector/memory.html.twig */
class __TwigTemplate_83b05d13ee9211a54245507a7021e586b14221b501f93414c9809216ef375463 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("@WebProfiler/Profiler/layout.html.twig");

        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        ob_start();
        // line 5
        echo "        <span>
            <img width=\"13\" height=\"28\" alt=\"Memory Usage\" src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA0AAAAcBAMAAABITyhxAAAAJ1BMVEXNzc3///////////////////////8/Pz////////////+NjY0/Pz9lMO+OAAAADHRSTlMAABAgMDhAWXCvv9e8JUuyAAAAQ0lEQVQI12MQBAMBBmLpMwoMDAw6BxjOOABpHyCdAKRzsNDp5eXl1KBh5oHBAYY9YHoDQ+cqIFjZwGCaBgSpBrjcCwCZgkUHKKvX+wAAAABJRU5ErkJggg==\">
            <span>";
        // line 7
        echo twig_escape_filter($this->env, sprintf("%.1f", (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "memory") / 1024) / 1024)), "html", null, true);
        echo " MB</span>
        </span>
    ";
        $context["icon"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 10
        echo "    ";
        ob_start();
        // line 11
        echo "        <div class=\"sf-toolbar-info-piece\">
            <b>Memory usage</b>
            <span>";
        // line 13
        echo twig_escape_filter($this->env, sprintf("%.1f", (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "memory") / 1024) / 1024)), "html", null, true);
        echo " / ";
        echo ((($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "memoryLimit") == (-1))) ? ("&infin;") : (twig_escape_filter($this->env, sprintf("%.1f", (($this->getAttribute((isset($context["collector"]) ? $context["collector"] : $this->getContext($context, "collector")), "memoryLimit") / 1024) / 1024)))));
        echo " MB</span>
        </div>
    ";
        $context["text"] = ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
        // line 16
        echo "    ";
        $this->env->loadTemplate("@WebProfiler/Profiler/toolbar_item.html.twig")->display(array_merge($context, array("link" => false)));
    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/memory.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 16,  51 => 13,  34 => 5,  31 => 4,  810 => 492,  807 => 491,  796 => 489,  792 => 488,  788 => 486,  775 => 485,  749 => 479,  746 => 478,  727 => 476,  710 => 475,  706 => 473,  702 => 472,  698 => 471,  694 => 470,  690 => 469,  686 => 468,  682 => 467,  679 => 466,  677 => 465,  660 => 464,  649 => 462,  634 => 456,  629 => 454,  625 => 453,  622 => 452,  620 => 451,  606 => 449,  601 => 446,  567 => 414,  549 => 411,  532 => 410,  529 => 409,  527 => 408,  522 => 406,  517 => 404,  199 => 93,  196 => 92,  188 => 90,  182 => 87,  176 => 86,  173 => 85,  165 => 83,  153 => 77,  141 => 73,  123 => 61,  116 => 57,  106 => 51,  84 => 40,  68 => 30,  62 => 27,  50 => 22,  28 => 3,  357 => 123,  351 => 120,  344 => 119,  341 => 118,  332 => 116,  327 => 114,  324 => 113,  318 => 111,  306 => 107,  303 => 106,  300 => 105,  297 => 104,  291 => 102,  278 => 98,  263 => 95,  258 => 94,  243 => 92,  231 => 83,  224 => 81,  212 => 78,  202 => 94,  190 => 76,  187 => 75,  185 => 74,  174 => 65,  156 => 62,  145 => 74,  143 => 51,  139 => 49,  136 => 71,  131 => 45,  122 => 41,  119 => 40,  117 => 39,  112 => 36,  104 => 32,  101 => 31,  98 => 45,  92 => 43,  85 => 24,  75 => 19,  72 => 18,  69 => 17,  58 => 25,  44 => 10,  41 => 19,  38 => 7,  161 => 63,  158 => 80,  154 => 60,  151 => 59,  140 => 58,  125 => 42,  121 => 50,  118 => 49,  113 => 48,  111 => 47,  100 => 39,  96 => 37,  87 => 41,  83 => 33,  64 => 23,  49 => 11,  46 => 10,  43 => 12,  35 => 6,  32 => 6,  27 => 3,  91 => 33,  88 => 25,  80 => 32,  63 => 18,  52 => 12,  45 => 9,  389 => 160,  386 => 159,  380 => 158,  378 => 157,  371 => 156,  367 => 155,  363 => 126,  361 => 152,  358 => 151,  355 => 150,  353 => 121,  345 => 147,  343 => 146,  340 => 145,  334 => 141,  331 => 140,  328 => 139,  326 => 138,  321 => 112,  315 => 110,  312 => 109,  309 => 108,  307 => 128,  302 => 125,  296 => 121,  293 => 120,  290 => 119,  288 => 101,  283 => 100,  281 => 114,  276 => 111,  274 => 97,  269 => 107,  265 => 96,  259 => 103,  255 => 93,  253 => 100,  248 => 97,  246 => 136,  241 => 93,  235 => 85,  232 => 88,  229 => 87,  227 => 86,  222 => 83,  216 => 79,  213 => 78,  210 => 77,  208 => 76,  203 => 73,  197 => 69,  194 => 68,  191 => 67,  189 => 66,  184 => 63,  178 => 66,  175 => 65,  172 => 64,  170 => 84,  166 => 54,  163 => 82,  155 => 47,  152 => 46,  147 => 75,  144 => 42,  134 => 54,  127 => 35,  120 => 31,  109 => 52,  105 => 25,  102 => 40,  99 => 23,  94 => 21,  90 => 42,  82 => 28,  79 => 21,  76 => 34,  73 => 33,  70 => 15,  67 => 24,  61 => 15,  55 => 24,  47 => 11,  42 => 7,  39 => 6,  36 => 5,  33 => 4,  30 => 5,);
    }
}
