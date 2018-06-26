#Debugging
config.contentObjectExceptionHandler = 0


plugin.tx_simpleblog_bloglisting {
  view {
    templateRootPaths.0 = EXT:simpleblog/Resources/Private/Templates/
    templateRootPaths.1 = {$plugin.tx_simpleblog_bloglisting.view.templateRootPath}
    partialRootPaths.0 = EXT:simpleblog/Resources/Private/Partials/
    partialRootPaths.1 = {$plugin.tx_simpleblog_bloglisting.view.partialRootPath}
    layoutRootPaths.0 = EXT:simpleblog/Resources/Private/Layouts/
    layoutRootPaths.1 = {$plugin.tx_simpleblog_bloglisting.view.layoutRootPath}
  }
  persistence {
    storagePid = {$plugin.tx_simpleblog_bloglisting.persistence.storagePid}
     storagePid = 0,13,15,16,17,18
    #storagePid = 12
    #recursive = 1
    classes {
      Pluswerk\Simpleblog\Domain\Model\Blog {
        newRecordStoragePid = 13
      }
      Pluswerk\Simpleblog\Domain\Model\Post {
        newRecordStoragePid = 15
      }
      Pluswerk\Simpleblog\Domain\Model\Comment {
        newRecordStoragePid = 16
      }
      Pluswerk\Simpleblog\Domain\Model\Tag {
        newRecordStoragePid = 17
      }


      Pluswerk\Simpleblog\Domain\Model\Author {
        mapping {
          tableName = fe_users
          columns {
            name.mapOnProperty = fullname
          }
        }
      }
    }
  }
  settings{
    loginpage = 20
    blog{
      max = 10
    }
  }
  features {
    #skipDefaultArguments = 1
  }
  mvc {
    #callDefaultActionIfActionCantBeResolved = 1
  }
}

plugin.tx_simpleblog._CSS_DEFAULT_STYLE (
    textarea.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    input.f3-form-error {
        background-color:#FF9F9F;
        border: 1px #FF0000 solid;
    }

    .tx-simpleblog table {
        border-collapse:separate;
        border-spacing:10px;
    }

    .tx-simpleblog table th {
        font-weight:bold;
    }

    .tx-simpleblog table td {
        vertical-align:top;
    }

    .typo3-messages .message-error {
        color:red;
    }

    .typo3-messages .message-ok {
        color:green;
    }
)
/*
TemplateParser does not exist.......... PDF 192
config.tx_extbase {
  objects {
    TYPO3\CMS\Fluid\Core\Parser\TemplateParser {
      className = Pluswerk\Simpleblog\View\TemplateParser
    }
  }
}
*/


page {
  includeCSS {
    bootstrap = EXT:simpleblog/Resources/Public/Css/Bootstrap/css/bootstrap.css
    simpleblog = EXT:simpleblog/Resources/Public/Css/simpleblog.css
    fontawesome = https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css
    fontawesome.external = 1

  }
  includeJSFooterlibs{
    jquery = //code.jquery.com/jquery.js
    jquery.external = 1
    bootstrap = EXT:simpleblog/Resources/Public/JavaScript/js/bootstrap.js
  }
}

ajax = PAGE
ajax {
  typeNum = 99
  config {
    disableAllHeaderCode = 1
    additionalHeaders = Content-type:application/json
    admPanel = 0
    debug = 0
  }
  10 < tt_content.list.20.simpleblog_bloglisting
}
/*
  Sprache Konfiguration
• linkVars sorgt dafür, dass der Sprachparameter L an alle intern erzeugten Links angehängt wird, wenn
er einmal gesetzt wurde.
• Nun wird die Default-Sprache so konfiguriert, dass sie der englischen Sprache entspricht.
• Wenn nun der Sprachparameter auf den Wert 1 gesetzt wird (indem man beispielsweise &L=1 an die URL
hängt), konfiguriert die entsprechende Condition das Sprachhandling so um, dass dies der deutschen
Sprache entspricht.

ACHTUNG man soll in Url der Startseite (bzw dawo überall Seit ID gibt) &L= 1 einsetzten damit Deutsch sprache geladen wird
BSP http://kvmwww4/bbawtypo3praktik/index.php?id=11&L=1

*/
config.linkVars = L
config.uniqueLinkVars = 1
config {
  sys_language_uid = 0
  language = default
  locale_all = en_US
  htmlTag_langKey = en
  htmlTag_setParams = lang="en" dir="ltr" class="no-js"
}
[globalVar = GP:L = 1]
  config {
    sys_language_uid = 1
    language = de
    locale_all = de_DE.utf8
    htmlTag_langKey = de
    htmlTag_setParams = lang="de" dir="ltr" class="no-js"
  }
[global]




// Rss Web Feed

rss = PAGE
rss {
  typeNum = 100
  10 = USER
  10 {
    userFunc = TYPO3\CMS\Extbase\Core\Bootstrap->run
    extensionName = Simpleblog
    pluginName = Bloglisting
    vendorName = Pluswerk
    controller = Blog
    action = rss
    switchableControllerActions {
      Blog {
        1 = rss
      }
    }
    settings =< plugin.tx_simpleblog_bloglisting.settings
    persistence =< plugin.tx_simpleblog_bloglisting.persistence
    view =< plugin.tx_simpleblog_bloglisting.view
  }
  config {
    disableAllHeaderCode = 1
    additionalHeaders = Content-type:application/xml
    debug = 0
    admPanel = 0
  }
}
