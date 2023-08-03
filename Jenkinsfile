pipeline {
    agent {
        dockerfile true
    }
    stages {
        stage('Prepare website') {
            steps {
                sh 'pwd'
                sh 'ls -al'
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
                                    sourceFiles: 'py4e-pl/',
                                    removePrefix: 'py4e-pl'
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
