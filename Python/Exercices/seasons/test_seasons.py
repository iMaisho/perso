import pytest
from seasons import convert, delta, words
import datetime

def test_convert():
   assert convert("1995-12-16") == datetime.date(1995,12,16)
   with pytest.raises(SystemExit):
      convert("January 1, 1999")

def test_delta():
   assert delta(datetime.date(1995,12,16)) == datetime.timedelta(days=10264)

def test_words():
   assert words(datetime.timedelta(days=10264)) == "fourteen million, seven hundred eighty thousand, one hundred sixty"
