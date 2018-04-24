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
    # storagePid = 0,13,15,16,17
    storagePid = 12
    recursive = 1
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
  }
  includeJSLibs {
    jquery = //code.jquery.com/jquery.js
    jquery.external = 1
    bootstrap = EXT:simpleblog/Resources/Public/JavaScript/js/bootstrap.js
  }
}