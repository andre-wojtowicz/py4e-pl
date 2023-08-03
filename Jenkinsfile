pipeline {
    agent {
        dockerfile true
    }
    stages {
        stage('Clean workspace') {
            steps {
                sh 'rm -rf dest'
                sh 'cp -r app dest'
            }
        }
        stage('Prepare book') {
            steps {
                sh 'cd dest && bash prep.sh'
            }
        }
        stage('Prepare website') {
            steps {
                sh '''cd dest
                git clone https://github.com/oupala/apaxy.git
                cp .htaccess .htaccess.orig
                cd apaxy
                ./apaxy-configure.sh -d ..
                cd ..
                cat .htaccess >> .htaccess.orig
                mv .htaccess.orig .htaccess
                '''
                sh '''cd dest
                git clone https://github.com/andre-wojtowicz/tsugi.git
                '''
                sh '''cd dest/mod
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
        stage('Publish') {
            steps {
                sshPublisher(
                    continueOnError: false, 
                    failOnError: true,
                    publishers: [
                        sshPublisherDesc(
                            configName: "andre-py4epl",
                            transfers: [
                                sshTransfer(
                                    execCommand: 'shopt -s dotglob && rm -rf ~/public_html/*'
                                ),
                                sshTransfer(
                                    remoteDirectory: 'public_html',
                                    sourceFiles: 'dest/',
                                    removePrefix: 'dest'
                                ),
                                sshTransfer(
                                    execCommand: 'bash customize.sh'
                                ),
                                sshTransfer(
                                    execCommand: 'find public_html -type d -print0 | xargs -0 chmod 755'
                                ),
                                sshTransfer(
                                    execCommand: 'find public_html -type f -print0 | xargs -0 chmod 644'
                                )
                            ],
                            verbose: true
                        )
                    ]
                )
            }
        }
    }
}
