<?php

use Phalcon\Mvc\Controller;
use Phalcon\Translate\Adapter\NativeArray;
use Phalcon\Translate\InterpolatorFactory;
use Phalcon\Translate\TranslateFactory;

/**
 * @property Phalcon\Http\Request $request
 * @property Phalcon\Mvc\View     $view
 */
class LanguageController extends Controller
{

    public function indexAction()
    {
        $this->view->name = "Mike";
        $this->view->song = "Ton sourire m'ensorcelle Je suis fou de toi Le désir coule dans mes veines Guidé par ta voix";
        $this->view->t    = $this->getTranslator();
    }

    /**
     * @return NativeArray
     */
    private function getTranslator(): NativeArray
    {
        // Ask browser what is the best language
        $language = $this->request->getBestLanguage('');
        $messages = [];

        $translationFile = APP_PATH . '/messages/fr.php';

        if (true !== file_exists($translationFile)) {
            $translationFile = APP_PATH . '/messages/fr.php';
        }

        require $translationFile;

        $interpolator = new InterpolatorFactory();
        $factory      = new TranslateFactory($interpolator);

        return $factory->newInstance(
            'array',
            [
                'content' => $messages,
            ]
        );
    }
}
