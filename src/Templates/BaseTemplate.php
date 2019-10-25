<?php
namespace Cubetech\Templates;
use \Cubetech\Rendering\TemplatePart;
use \Cubetech\Rendering\RenderableList;
use \Cubetech\Rendering\IRenderable;
use \Cubetech\Base\BaseHeader;
use \Cubetech\Base\Footer;
use \Cubetech\Helpers\RestrictionHandler;
use Cubetech\Base\CubetechPost;
use Cubetech\TemplateLogic\FooterLogic;
use Cubetech\TemplateLogic\NavigationLogic;
/**
 * Base Template class for every template used from the Theme
 *
 * @author Alex Scherer <alex.scherer@cubetech.ch>
 * @since 1.0.0
 * @version 1.0.0
 */
abstract class BaseTemplate
{
    
    private $name;
    public $menuItems;
    protected $primaryPostId;
    protected $headerList;
    protected $sidebarList;
    protected $contentList;
    protected $footerList;
    protected $hasSidebar;
    protected $head;
    protected $navigation;
    protected $mobileNavigation;
    protected $iconPrint;
    
    public function __construct($name)
    {
        
        $this->name = $name;
        $this->hasSidebar = false;
        $this->setPrimaryPostId();
        
        $post = new CubetechPost($this->getId());
        $footer = new TemplatePart('footers/default-footer', new FooterLogic());
        
        if ($post->getField('is_sidebar_active')) {
            $this->hasSidebar = true;
        }
        
        $this->head = new TemplatePart('head');
        $this->headerList = new RenderableList();
        $this->contentList = new RenderableList();
        $this->sidebarList = new RenderableList();
        $this->footerList = new RenderableList();
        $this->navigation = new TemplatePart('navigations/navigation', new NavigationLogic('primary'));
        $this->footerList->append($footer);
        var_dump($this->contentList);
    }
    
    public function setSidebar(\Cubetech\Sidebars\BaseSidebar $sidebar)
    {
        $this->sidebar = $sidebar;
        $this->hasSidebar = true;
    }
    
    public function setHeader(BaseHeader $header)
    {
        $this->header = $header;
    }
    
    protected function setPrimaryPostId()
    {
        $this->primaryPostId = get_the_id();
    }
    
    public function getId()
    {
        return $this->primaryPostId;
    }
    
    final public function render()
    {
        $this->head->render();
        
        if ($this->navigation) {
            $this->navigation->render();
        }
        
        if ( !$this->headerList->empty()) {
            $this->headerList->render();
        }
        
        if ($this->hasSidebar) {
            echo '<div class="ct-main ct-main-sidebar"><div class="uk-container"><div class="uk-grid">';
            $this->sidebarList->render();
            echo '<main class="ct-main-content uk-width-2-3@m uk-width-3-4@l">';
        }
        else {
            echo '<main class="ct-main"><div class="ct-main-content">';
        }
        
        $this->contentList->render();
        
        
        if ($this->hasSidebar) {
            echo '</main></div></div></div>';
        }
        else {
            echo '</div></main>';
        }
        
        if ( !$this->footerList->empty()) {
            $this->footerList->render();
        }
    }
    
}