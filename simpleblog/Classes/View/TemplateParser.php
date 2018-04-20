<?php
/*
 * Dies sorgt dafür, dass Sie in allen Templates nun auf die Angabe des Namespaces {namespace simpleblog
= Pluswerk\Simpleblog\ViewHelpers} verzichten können und so beispielsweise einen ViewHelper wie
<simpleblog:viewHelperName> direkt verwenden können, ohne ihn jedesmals als Namespace im Template
angeben zu müssen.
 */
namespace Pluswerk\Simpleblog\View;
class TemplateParser extends \TYPO3\CMS\Fluid\Core\Parser\TemplateParser {
    protected $namespacesBase = array();
    public function initializeObject() {
        $this->namespacesBase = $this->namespaces += array(
            'simpleblog' => 'Pluswerk\Simpleblog\ViewHelpers'
        );
    }
    protected function reset() {
        $this->namespaces = $this->namespacesBase;
    }
}
?>