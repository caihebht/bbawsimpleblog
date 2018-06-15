lib.language = COA
lib.language {


    11 = TEXT
    11.value = <p>Sprache</p>
    20 = HMENU
    20 {
        special = language
        special.value = 0,1
        special.normalWhenNoLanguage = 0
        wrap =
        1 = TMENU
        1 {
            noBlur = 1
            NO = 1
            NO {
                doNotLinkIt = 0
                linkWrap = <li>|</li>
                stdWrap.override = English || Deutsch
                stdWrap {
                    typolink {
                        parameter.data = page:uid
                        additionalParams = &L=0 || &L=1
                        ATagParams = hreflang="en-GB" class="language" || hreflang="de-DE" class="language"


                    }
                }
            }
        }
    }
    wrap = <ul id="language_menu" class="language-menu">|</ul>
}