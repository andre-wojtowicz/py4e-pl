pipeline {
    agent {
        dockerfile true
    }
    stages {
        stage('Prepare book') {
            steps {
                sh 'pwd'
                sh 'ls -al'
                sh 'cd app && bash prep.sh'
            }
        }
        stage('Prepare website') {
            steps {
                sh '''cd app
                git clone https://github.com/oupala/apaxy.git
                cp .htaccess .htaccess.orig
                cd apaxy
                ./apaxy-configure.sh -d ..
                cd ..
                cat .htaccess >> .htaccess.orig
                mv .htaccess.orig .htaccess
                '''
                sh '''cd app
                git clone https://github.com/andre-wojtowicz/tsugi.git
                mv config-tsugi.php tsugi/config.php
                '''
                sh '''cd app/mod
                git clone https://github.com/tsugitools/gift.git
                git clone https://github.com/tsugitools/peer-grade.git
                cd ../mod_translation
                cd peer-grade
                bash change.sh
                cd ../gift
                bash change.sh
                '''
            }
        }
    }
}
