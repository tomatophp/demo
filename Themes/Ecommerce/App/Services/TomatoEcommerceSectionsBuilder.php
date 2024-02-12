<?php

namespace Themes\Ecommerce\App\Services;

use TomatoPHP\TomatoCms\Facades\TomatoCMS;
use TomatoPHP\TomatoForms\Facades\TomatoForms;
use TomatoPHP\TomatoSections\Sections\TomatoCategorySection;
use TomatoPHP\TomatoSections\Sections\TomatoFeatureSection;
use TomatoPHP\TomatoSections\Sections\TomatoFooterSection;
use TomatoPHP\TomatoSections\Sections\TomatoHeaderSection;
use TomatoPHP\TomatoSections\Sections\TomatoHeroSection;
use TomatoPHP\TomatoSections\Sections\TomatoProductsSection;
use TomatoPHP\TomatoThemes\Facades\TomatoThemes;

class TomatoEcommerceSectionsBuilder
{
    public static function build(): void
    {
        TomatoHeaderSection::build();
        TomatoHeroSection::build();
        TomatoCategorySection::build();
        TomatoProductsSection::build();
        TomatoFeatureSection::build();
        TomatoFooterSection::build();

        //Create Section Forms
        TomatoForms::build();
        TomatoCMS::build();
        TomatoThemes::build();
    }
}
