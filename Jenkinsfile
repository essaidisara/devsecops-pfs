node {
    stage('SCM') {
        checkout scm
    }
    stage('SonarQube Analysis') {
        def scannerHome = tool 'SonarScanner';
        withSonarQubeEnv('SonarQube-Local') {
            sh "${scannerHome}/bin/sonar-scanner"
        }
    }
}
