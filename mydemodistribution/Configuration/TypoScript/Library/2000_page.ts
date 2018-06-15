# Default PAGE object:
    page = PAGE



## JavaScript laden

page.includeJSlibs {
    modernizr = {$resDir}/Public/JavaScript/vendor/modernizr-2.8.3-respond-1.4.2.min.js
}

##abstract
page.includeJSFooterlibs{
    jquery = {$resDir}/Public/JavaScript/vendor/jquery-1.11.2.min.js

}


page.includeJSFooter{
    main = {$resDir}/Public/JavaScript/main.js

}

## CSS Dateien laden xxx
page.includeCSS {
    normalize = {$resDir}/Public/Css/normalize.min.css
    Main = {$resDir}/Public/Css/main.css
}

    page.10 = FLUIDTEMPLATE
    page.10{
        partialRootPath = {$resDir}/Private/Partials
        layoutRootPath = {$resDir}/Private/Layouts

        variables {
            /*
            variable definieren
            1.   name   =  typ
            bsp  siteName = TEXT
            2. Wert setzen z.b
                siteName.value = hello world
            3. mit {} kann man die Variable in HTML einsetzen
            bsp <h3> {siteName}</h3>

            styles.content.get = content parsen
            contentMain < styles.content.get   = geparset content in Variable cotentMain kopieren(<)
            es wird automatisch colPos = 0 genommen
            mit  select.where kann explizit angeben welche columns man nehmen will
            */

            contentMain < styles.content.get

            contentAside < styles.content.get

            contentAside.select.where = colPos = 1

            #aside wird nur angezeigt werden, wenn es  nur Elemente  da drin sich befinde
            contentAside.stdWrap {
                wrap = <aside >|</aside>
                    required = 1
            }

        }
       file = {$resDir}/Private/Templates/DefaultTemplate.html
    }

# ++++++++++++page Object mit CASE versehen Ziel====>abhängig von gewählt Backendlayout, soll entsprechende Templates zugewiesen werden    ---> abfragen (auswertung)
/*          <<geht nicht>>
page.10.file.stdWrap.cObject = CASE
page.10.file.stdWrap.cObject {
    key.data = levelfield:-1, backend_layout_next_level, slide
    key.override.field = backend_layout

    # default Template
    default = Text
    default.value = {$resDir}/Private/Templates/DefaultTemplate.html

    1 < .default

    2 = Text
    2.value = {$resDir}}/Private/Templates/LayouteinSpalt.html
}
*/
/* CSS datein anhand ausgewählt Layout ändern  <<geht nicht>>

page.headerData.10 = CASE
page.headerData.10 {
    stdWrap.wrap = <link rel="stylesheet" type="text/css" href="{$resDir}/Public/Css" media="all" />
    key.data = levelfield:-1, backend_layout_next_level, slide
    key.override.field = backend_layout

    default = TEXT
    default.value = main.css

    1 <.default

    2 = TEXT
    2.value = main_1spalt.css
}
*/