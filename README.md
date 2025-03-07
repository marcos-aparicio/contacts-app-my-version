# contacts-app-my-version

## Extended version of Mastermind's PHP's course final project

Changed the code to be more modularized (I hope), added dark and light mode and other things.

This is an old project so a lot of code that you see here is not practical by any means and serves merely as a learning experience. I apologize if the requests are slow because of that.


### Docker Development Setup

Set up in other environments would be difficult to document all in one place so i'll only cover how to get this to hopefully work on Docker 🐳:

```bash
# clone the repo
git clone https://github.com/marcos-aparicio/contacts-app-my-version.git
cd contacts-app-my-version
# don't worry, i know this is the least efficient way to change themes lol
echo '{"color":"light"}' > ./theme_changes/colors.json
cp .env.example .env
# make sure to check the .env before so that any ports and credentials are adjusted to your preference
docker compose up -d
```

After that you should see the application on `localhost:8080` if the `.env` is the same as `.env.example`
