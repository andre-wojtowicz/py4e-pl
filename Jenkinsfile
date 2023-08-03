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
                sh 'pwd'
                sh 'ls -al .'
            }
        }
    }
}
