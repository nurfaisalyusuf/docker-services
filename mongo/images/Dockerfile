FROM alpine:3.9
LABEL Maintainer="Young Martin 45 <young.martin45@gmail.com>" \
    Description="MongoDB based on Alpine Linux 3.9."

RUN apk --no-cache --update add \
            mongodb mongodb-tools

# RUN mkdir -p /data/db

# EXPOSE 27017
# CMD ["mongod"]
COPY run.sh /root
RUN mkdir -p /data/db && chmod 755 /root/run.sh

ENTRYPOINT [ "/root/run.sh" ]
CMD [ "mongod", "--bind_ip", "0.0.0.0" ]