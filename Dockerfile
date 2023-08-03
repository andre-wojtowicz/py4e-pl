FROM 'debian:11.7-slim'

RUN echo '\
Acquire::Retries "100";\
Acquire::https::Timeout "30";\
Acquire::http::Timeout "30";\
Acquire::ftp::Timeout "30";\
APT::Get::Assume-Yes "true";\
APT::Install-Recommends "false";\
APT::Install-Suggests "false";\
' > /etc/apt/apt.conf.d/99custom && \
    apt update && \
    apt upgrade -y && \
    apt install -y locales && \
    rm -rf /var/lib/apt/lists/* && \
    localedef -i en_US -c -f UTF-8 -A /usr/share/locale/locale.alias en_US.UTF-8
ENV LANG en_US.utf8
RUN apt update && \
    apt install -y python3 python3-pip make wget curl zip unzip git pandoc python2 pcregrep calibre texlive-full pdftk paps qpdf jq
