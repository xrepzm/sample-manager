## Sample Manager Application

App cans create requests, samples and users, or rahter save each other relations.

```sh
$ php artisan migrate:refresh --database="testing" --seed
```

---

Sample requests: http://sample-manager.dev/sample-requests{/:id}

Request samples: http://sample-manager.dev/request-samples{/:id}

- [ ] Accepting, finishing and refusing requests
