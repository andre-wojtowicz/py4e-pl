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
                mv config-tsugi.php tsugi/config.php
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
        stage('Customize') {
            steps {
                // Using three Secret Text credentials in one withCredentials block
                withCredentials([
                    string(credentialsId: '___APP_HOME___', variable: '___APP_HOME___', domain='py4epl'),
                    string(credentialsId: '___WWW_ROOT___', variable: '___WWW_ROOT___', domain='py4epl'),
                    string(credentialsId: '___PDO___', variable: '___PDO___', domain='py4epl'),
                    string(credentialsId: '___DB_USER___', variable: '___DB_USER___', domain='py4epl'),
                    string(credentialsId: '___DB_PASS___', variable: '___DB_PASS___', domain='py4epl'),
                    string(credentialsId: '___ADMIN_PW___', variable: '___ADMIN_PW___', domain='py4epl'),
                    string(credentialsId: '___CONTEXT_TITLE___', variable: '___CONTEXT_TITLE___', domain='py4epl'),
                    string(credentialsId: '___SERVICE_NAME___', variable: '___SERVICE_NAME___', domain='py4epl'),
                    string(credentialsId: '___OWNER_NAME___', variable: '___OWNER_NAME___', domain='py4epl'),
                    string(credentialsId: '___OWNER_EMAIL___', variable: '___OWNER_EMAIL___', domain='py4epl'),
                    string(credentialsId: '___GOOGLE_CLIENT_ID___', variable: '___GOOGLE_CLIENT_ID___', domain='py4epl'),
                    string(credentialsId: '___GOOGLE_CLIENT_SECRET___', variable: '___GOOGLE_CLIENT_SECRET___', domain='py4epl'),
                    string(credentialsId: '___EXPIRE_PII_DAYS___', variable: '___EXPIRE_PII_DAYS___', domain='py4epl'),
                    string(credentialsId: '___EXPIRE_USER_DAYS___', variable: '___EXPIRE_USER_DAYS___', domain='py4epl'),
                    string(credentialsId: '___EXPIRE_CONTEXT_DAYS___', variable: '___EXPIRE_CONTEXT_DAYS___', domain='py4epl'),
                    string(credentialsId: '___EXPIRE_TENANT_DAYS___', variable: '___EXPIRE_TENANT_DAYS___', domain='py4epl'),
                    string(credentialsId: '___DEVELOPER___', variable: '___DEVELOPER___', domain='py4epl'),
                    string(credentialsId: '___COOKIE_SECRET___', variable: '___COOKIE_SECRET___', domain='py4epl'),
                    string(credentialsId: '___COOKIE_NAME___', variable: '___COOKIE_NAME___', domain='py4epl'),
                    string(credentialsId: '___COOKIE_PAD___', variable: '___COOKIE_PAD___', domain='py4epl'),
                    string(credentialsId: '___MAIL_DOMAIN___', variable: '___MAIL_DOMAIN___', domain='py4epl'),
                    string(credentialsId: '___MAIL_SECRET___', variable: '___MAIL_SECRET___', domain='py4epl'),
                    string(credentialsId: '___SESSION_SALT___', variable: '___SESSION_SALT___', domain='py4epl'),
                    string(credentialsId: '___UNIVERSAL_ANALYTICS___', variable: '___UNIVERSAL_ANALYTICS___', domain='py4epl'),
                    string(credentialsId: '___PY4EPL_PRIVATE___', variable: '___PY4EPL_PRIVATE___', domain='py4epl')
                ]) {
                    sh '''cd dest
                    git clone $___PY4EPL_PRIVATE___
                    sed -i -e "s~___APP_HOME___~$___APP_HOME___~g" \
                           -e "s~___WWW_ROOT___~$___WWW_ROOT___~g" \
                           -e "s~___PDO___~$___PDO___~g" \
                           -e "s~___DB_USER___~$___DB_USER___~g" \
                           -e "s~___DB_PASS___~$___DB_PASS___~g" \
                           -e "s~___ADMIN_PW___~$___ADMIN_PW___~g" \
                           -e "s~___CONTEXT_TITLE___~$___CONTEXT_TITLE___~g" \
                           -e "s~___SERVICE_NAME___~$___SERVICE_NAME___~g" \
                           -e "s~___OWNER_NAME___~$___OWNER_NAME___~g" \
                           -e "s~___OWNER_EMAIL___~$___OWNER_EMAIL___~g" \
                           -e "s~___GOOGLE_CLIENT_ID___~$___GOOGLE_CLIENT_ID___~g" \
                           -e "s~___GOOGLE_CLIENT_SECRET___~$___GOOGLE_CLIENT_SECRET___~g" \
                           -e "s~___EXPIRE_PII_DAYS___~$___EXPIRE_PII_DAYS___~g" \
                           -e "s~___EXPIRE_USER_DAYS___~$___EXPIRE_USER_DAYS___~g" \
                           -e "s~___EXPIRE_CONTEXT_DAYS___~$___EXPIRE_CONTEXT_DAYS___~g" \
                           -e "s~___EXPIRE_TENANT_DAYS___~$___EXPIRE_TENANT_DAYS___~g" \
                           -e "s~___DEVELOPER___~$___DEVELOPER___~g" \
                           -e "s~___COOKIE_SECRET___~$___COOKIE_SECRET___~g" \
                           -e "s~___COOKIE_NAME___~$___COOKIE_NAME___~g" \
                           -e "s~___COOKIE_PAD___~$___COOKIE_PAD___~g" \
                           -e "s~___MAIL_DOMAIN___~$___MAIL_DOMAIN___~g" \
                           -e "s~___MAIL_SECRET___~$___MAIL_SECRET___~g" \
                           -e "s~___SESSION_SALT___~$___SESSION_SALT___~g" \
                           -e "s~___UNIVERSAL_ANALYTICS___~$___UNIVERSAL_ANALYTICS___~g" \
                    tsugi/config.php
                    '''
                }
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
